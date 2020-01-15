<?php

namespace Jane\JsonSchema\Generator\Normalizer;

use Jane\JsonSchema\Generator\Context\Context;
use Jane\JsonSchema\Generator\Naming;
use Jane\JsonSchema\Guesser\Guess\ClassGuess;
use PhpParser\Node\Arg;
use PhpParser\Node\Name;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt;
use PhpParser\Node\Expr;
use PhpParser\Node\Scalar;

trait DenormalizerGenerator
{
    /**
     * The naming service.
     *
     * @return Naming
     */
    abstract protected function getNaming();

    /**
     * Create method to check if denormalization is supported.
     *
     * @param string $modelFqdn Fully Qualified name of the model class denormalized
     *
     * @return Stmt\ClassMethod
     */
    protected function createSupportsDenormalizationMethod(string $modelFqdn)
    {
        return new Stmt\ClassMethod('supportsDenormalization', [
            'type' => Stmt\Class_::MODIFIER_PUBLIC,
            'params' => [
                new Param(new Expr\Variable('data')),
                new Param(new Expr\Variable('type')),
                new Param(new Expr\Variable('format'), new Expr\ConstFetch(new Name('null'))),
            ],
            'stmts' => [new Stmt\Return_(new Expr\BinaryOp\Identical(new Expr\Variable('type'), new Scalar\String_($modelFqdn)))],
        ]);
    }

    protected function createDenormalizeMethod(string $modelFqdn, Context $context, ClassGuess $classGuess): Stmt\ClassMethod
    {
        $context->refreshScope();
        $objectVariable = new Expr\Variable('object');
        $statements = [];

        if ($this->useReference) {
            $statements[] = new Stmt\If_(
                new Expr\Isset_([new Expr\PropertyFetch(new Expr\Variable('data'), "{'\$ref'}")]),
                [
                    'stmts' => [
                        new Stmt\Return_(new Expr\New_(new Name('Reference'), [
                            new Arg(new Expr\PropertyFetch(new Expr\Variable('data'), "{'\$ref'}")),
                            new Arg(new Expr\ArrayDimFetch(new Expr\Variable('context'), new Scalar\String_('document-origin'))),
                        ])),
                    ],
                ]
            );
            $statements[] = new Stmt\If_(
                new Expr\Isset_([new Expr\PropertyFetch(new Expr\Variable('data'), "{'\$recursiveRef'}")]),
                [
                    'stmts' => [
                        new Stmt\Return_(new Expr\New_(new Name('Reference'), [
                            new Arg(new Expr\PropertyFetch(new Expr\Variable('data'), "{'\$recursiveRef'}")),
                            new Arg(new Expr\ArrayDimFetch(new Expr\Variable('context'), new Scalar\String_('document-origin'))),
                        ])),
                    ],
                ]
            );
        }

        $statements[] = new Stmt\Expression(new Expr\Assign($objectVariable, new Expr\New_(new Name('\\' . $modelFqdn))));

        array_unshift($statements, ...$this->denormalizeMethodStatements($classGuess, $context));

        $unset = \count($classGuess->getExtensionsType()) > 0;

        if ($unset) {
            // Force cloning when unsetting to not loose data for references
            $statements[] = new Stmt\Expression(new Expr\Assign(new Expr\Variable('data'), new Expr\Clone_(new Expr\Variable('data'))));
        }

        foreach ($classGuess->getProperties() as $property) {
            $propertyVar = new Expr\PropertyFetch(new Expr\Variable('data'), sprintf("{'%s'}", $property->getName()));
            list($denormalizationStatements, $outputVar) = $property->getType()->createDenormalizationStatement($context, $propertyVar);

            $baseCondition = new Expr\FuncCall(new Name('property_exists'), [
                new Arg(new Expr\Variable('data')),
                new Arg(new Scalar\String_($property->getName())),
            ]);
            $fullCondition = $baseCondition;

            $mutatorStmt = array_merge($denormalizationStatements, [
                new Stmt\Expression(new Expr\MethodCall($objectVariable, $this->getNaming()->getPrefixedMethodName('set', $property->getPhpName()), [$outputVar])),
            ], $unset ? [new Stmt\Unset_([$propertyVar])] : []);

            if (!$context->isStrict() || $property->isNullable()) {
                $fullCondition = new Expr\BinaryOp\BooleanAnd(
                    $baseCondition,
                    new Expr\BinaryOp\NotIdentical(
                        $propertyVar,
                        new Expr\ConstFetch(new Name('null'))
                    )
                );
            }

            $statements[] = new Stmt\If_($fullCondition, [
                'stmts' => $mutatorStmt,
            ]);

            if (!$context->isStrict() || $property->isNullable()) {
                $invertCondition = new Expr\BinaryOp\BooleanAnd(
                    $baseCondition,
                    new Expr\BinaryOp\Identical(
                        $propertyVar,
                        new Expr\ConstFetch(new Name('null'))
                    )
                );

                $statements[] = new Stmt\ElseIf_($invertCondition, [
                    new Stmt\Expression(new Expr\MethodCall($objectVariable, $this->getNaming()->getPrefixedMethodName('set', $property->getPhpName()), [new Expr\ConstFetch(new Name('null'))])),
                ]);
            }
        }

        $patternCondition = [];
        $loopKeyVar = new Expr\Variable($context->getUniqueVariableName('key'));
        $loopValueVar = new Expr\Variable($context->getUniqueVariableName('value'));

        foreach ($classGuess->getExtensionsType() as $pattern => $type) {
            list($denormalizationStatements, $outputVar) = $type->createDenormalizationStatement($context, $loopValueVar);

            $patternCondition[] = new Stmt\If_(
                new Expr\FuncCall(new Name('preg_match'), [
                    new Arg(new Expr\ConstFetch(new Name("'/" . str_replace('/', '\/', $pattern) . "/'"))),
                    new Arg($loopKeyVar),
                ]),
                [
                    'stmts' => array_merge($denormalizationStatements, [
                        new Stmt\Expression(new Expr\Assign(new Expr\ArrayDimFetch($objectVariable, $loopKeyVar), $outputVar)),
                    ]),
                ]
            );
        }

        if (\count($patternCondition) > 0) {
            $statements[] = new Stmt\Foreach_(new Expr\Variable('data'), $loopValueVar, [
                'keyVar' => $loopKeyVar,
                'stmts' => $patternCondition,
            ]);
        }
        $statements[] = new Stmt\Return_($objectVariable);

        return new Stmt\ClassMethod('denormalize', [
            'type' => Stmt\Class_::MODIFIER_PUBLIC,
            'params' => [
                new Param(new Expr\Variable('data')),
                new Param(new Expr\Variable('class')),
                new Param(new Expr\Variable('format'), new Expr\ConstFetch(new Name('null'))),
                new Param(new Expr\Variable('context'), new Expr\Array_(), 'array'),
            ],
            'stmts' => $statements,
        ]);
    }

    protected function denormalizeMethodStatements(ClassGuess $classGuess, Context $context): array
    {
        return [
            new Stmt\If_(
                new Expr\BooleanNot(new Expr\FuncCall(new Name('is_object'), [new Arg(new Expr\Variable('data'))])),
                [
                    'stmts' => [
                        $context->isStrict() ?
                            new Stmt\Throw_(new Expr\New_(new Name('InvalidArgumentException'), [
                                new Arg(new Expr\FuncCall(new Name('sprintf'), [new Arg(new Scalar\String_('Given $data is not an object (%s given). We need an object in order to continue denormalize method.')), new Arg(new Expr\FuncCall(new Name('gettype'), [new Arg(new Expr\Variable('data'))]))])),
                            ]))
                            :
                            new Stmt\Return_(new Expr\ConstFetch(new Name('null'))),
                    ],
                ]
            ),
        ];
    }
}

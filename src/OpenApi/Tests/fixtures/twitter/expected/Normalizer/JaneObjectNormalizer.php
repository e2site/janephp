<?php

namespace Jane\OpenApi\Tests\Expected\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    protected $normalizers = array('Jane\\OpenApi\\Tests\\Expected\\Model\\ContextAnnotation' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ContextAnnotationNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ContextAnnotationDomainFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ContextAnnotationDomainFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ContextAnnotationEntityFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ContextAnnotationEntityFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\EntityIndices' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\EntityIndicesNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\URLFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\URLFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\UrlEntity' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\UrlEntityNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\URLImage' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\URLImageNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\HashtagFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\HashtagFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\HashtagEntity' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\HashtagEntityNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CashtagFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CashtagFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CashtagEntity' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CashtagEntityNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\MentionFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\MentionFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\MentionEntity' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\MentionEntityNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\FullTextEntities' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\FullTextEntitiesNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\FullTextEntitiesAnnotationsItem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\FullTextEntitiesAnnotationsItemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Error' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ErrorNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Expansions' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ExpansionsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactTweetFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactTweetFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactTweetFieldsReferencedTweetsItem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactTweetFieldsReferencedTweetsItemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactTweetFieldsAttachments' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactTweetFieldsAttachmentsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultTweetFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultTweetFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultTweetFieldsGeo' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultTweetFieldsGeoNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedTweetFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedTweetFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedTweetFieldsStats' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedTweetFieldsStatsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactTweet' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactTweetNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultTweet' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultTweetNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedTweet' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedTweetNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactUserFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactUserFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultUserFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultUserFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultUserFieldsEntities' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultUserFieldsEntitiesNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultUserFieldsEntitiesUrl' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultUserFieldsEntitiesUrlNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedUserFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedUserFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedUserFieldsStats' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedUserFieldsStatsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactUser' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactUserNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultUser' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultUserNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedUser' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedUserNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\UserLookupResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\UserLookupResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\TweetLookupResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\TweetLookupResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\SingleTweetLookupResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\SingleTweetLookupResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\TweetMetricsResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\TweetMetricsResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Point' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\PointNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Geo' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\GeoNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Poll' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\PollNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\PollOption' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\PollOptionNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CommonMediaFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CommonMediaFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Photo' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\PhotoNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Video' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\VideoNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\AnimatedGif' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\AnimatedGifNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\TweetWithheld' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\TweetWithheldNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\UserWithheld' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\UserWithheldNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactPlaceFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactPlaceFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultPlaceFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultPlaceFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedPlaceFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedPlaceFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\CompactPlace' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\CompactPlaceNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DefaultPlace' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DefaultPlaceNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DetailedPlace' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DetailedPlaceNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ProblemFields' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ProblemFieldsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\GenericProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\GenericProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\InvalidRequestProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\InvalidRequestProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\InvalidRequestProblemErrorsItem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\InvalidRequestProblemErrorsItemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ResourceNotFoundProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ResourceNotFoundProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ResourceUnauthorizedProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ResourceUnauthorizedProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ClientForbiddenProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ClientForbiddenProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DisallowedResourceProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DisallowedResourceProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\UnsupportedAuthenticationProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\UnsupportedAuthenticationProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\UsageCapExceededProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\UsageCapExceededProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ConnectionExceptionProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ConnectionExceptionProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\ClientDisconnectedProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\ClientDisconnectedProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\OperationalDisconnectProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\OperationalDisconnectProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\RulesCapProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\RulesCapProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\InvalidRuleProblem' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\InvalidRuleProblemNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\TweetMetrics' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\TweetMetricsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\TweetInteractionMetrics' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\TweetInteractionMetricsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\VideoMetrics' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\VideoMetricsNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\Rule' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\RuleNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\RuleNoId' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\RuleNoIdNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\GetRulesResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\GetRulesResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\AddRulesRequest' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\AddRulesRequestNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\AddRulesResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\AddRulesResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DeleteRulesRequest' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DeleteRulesRequestNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\DeleteRulesResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\DeleteRulesResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\RulesResponseMetadata' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\RulesResponseMetadataNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\TweetSearchResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\TweetSearchResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\TweetSearchResponseMeta' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\TweetSearchResponseMetaNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\HideReplyRequest' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\HideReplyRequestNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\HideReplyResponse' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\HideReplyResponseNormalizer', 'Jane\\OpenApi\\Tests\\Expected\\Model\\HideReplyResponseData' => 'Jane\\OpenApi\\Tests\\Expected\\Normalizer\\HideReplyResponseDataNormalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null)
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
    }
    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }
    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
}
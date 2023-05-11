<?php /** @noinspection PhpInternalEntityUsedInspection */

namespace App\Normalizer;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;

abstract class AbstractNormalizer implements SubscribingHandlerInterface
{
    protected const DIRECTION_SERIALIZATION = GraphNavigator::DIRECTION_SERIALIZATION;
    protected const DIRECTION_DESERIALIZATION = GraphNavigator::DIRECTION_DESERIALIZATION;
    protected const FORMAT_JSON = 'json';
    protected const SERIALIZATION_METHOD = 'serialize';
    protected const DESERIALIZATION_METHOD = 'deserialize';

    public static function getSubscribingMethods(): array
    {
        $subscribingMethodList = [];
        $serializationType = static::getSerializationType();
        $deserializationType = static::getDeserializationType();

        if ($serializationType) {
            $serializationTypeParameterList = [
                'direction' => self::DIRECTION_SERIALIZATION,
                'format' => self::FORMAT_JSON,
                'type' => $serializationType,
                'method' => self::SERIALIZATION_METHOD,
            ];

            $serializationTypePriority = static::getSerializationPriority();
            if ($serializationTypePriority) {
                $serializationTypeParameterList['priority'] = $serializationTypePriority;
            }

            $subscribingMethodList[] = $serializationTypeParameterList;
        }

        if ($deserializationType) {
            $deserializationTypeParameterList = [
                'direction' => self::DIRECTION_DESERIALIZATION,
                'format' => self::FORMAT_JSON,
                'type' => $deserializationType,
                'method' => self::DESERIALIZATION_METHOD,
            ];

            $deserializationTypePriority = static::getDeserializationPriority();
            if ($deserializationTypePriority) {
                $deserializationTypeParameterList['priority'] = $deserializationTypePriority;
            }

            $subscribingMethodList[] = $deserializationTypeParameterList;
        }

        return $subscribingMethodList;
    }

    protected static function getSerializationType(): ?string
    {
        return null;
    }

    protected static function getDeserializationType(): ?string
    {
        return null;
    }

    protected static function getSerializationPriority(): ?int
    {
        return null;
    }

    protected static function getDeserializationPriority(): ?int
    {
        return null;
    }
}
<?php

namespace App\Normalizer\Api\Exception;

use App\Enum\Environment;
use App\Exception\Api\Http\InternalServerErrorHttpException;
use App\Kernel;
use App\Normalizer\AbstractNormalizer;
use Error;
use Exception;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Context;
use Throwable;

class ThrowableNormalizer extends AbstractNormalizer
{
    protected Kernel $kernel;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => self::DIRECTION_SERIALIZATION,
                'format' => self::FORMAT_JSON,
                'type' => Error::class,
                'method' => self::SERIALIZATION_METHOD,
            ],
            [
                'direction' => self::DIRECTION_SERIALIZATION,
                'format' => self::FORMAT_JSON,
                'type' => Exception::class,
                'method' => self::SERIALIZATION_METHOD,
            ]
        ];
    }

    public function serialize(
        JsonSerializationVisitor $visitor,
        Throwable $throwable,
        array $type,
        Context $context
    ): array {
        $data = [
            'message' => InternalServerErrorHttpException::MESSAGE,
            'details' => InternalServerErrorHttpException::MESSAGE,
            'technicalCode' => InternalServerErrorHttpException::TECHNICAL_CODE,
            'errorCode' => InternalServerErrorHttpException::ERROR_CODE
        ];

        if (in_array($this->kernel->getEnvironment(), [Environment::ENVIRONMENT_DEV, Environment::ENVIRONMENT_TEST])) {
            $data['exception'] = [
                'message' => $throwable->getMessage(),
                'file' => $throwable->getFile(),
                'line' => $throwable->getLine(),
                'trace' => $throwable->getTrace(),
            ];
        }

        return $data;
    }
}
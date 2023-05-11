<?php

namespace App\Normalizer\Api\Exception;

use App\Exception\Api\Http\AbstractHttpException;
use App\Normalizer\AbstractNormalizer;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Context;

class HttpExceptionNormalizer extends AbstractNormalizer
{
    protected static function getSerializationType(): ?string
    {
        return AbstractHttpException::class;
    }

    public function serialize(
        JsonSerializationVisitor $visitor,
        AbstractHttpException $exception,
        array $type,
        Context $context
    ): array {
        return [
            'message' => $exception->getMessage(),
            'details' => $exception->getDetails(),
            'technicalCode' => $exception->getTechnicalCode(),
            'errorCode' => $exception->getErrorCode()
        ];
    }
}
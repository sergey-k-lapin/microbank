<?php

namespace App\Normalizer\Api\Exception;

use App\Exception\Api\Http\ConflictHttpException;
use App\Exception\NotUniqueException;
use App\Normalizer\AbstractNormalizer;
use App\Service\NormalizerService;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Context;

class ConflictHttpExceptionNormalizer extends AbstractNormalizer
{
    protected NormalizerService $normalizerService;

    public function __construct(NormalizerService $normalizerService)
    {
        $this->normalizerService = $normalizerService;
    }

    protected static function getSerializationType(): ?string
    {
        return ConflictHttpException::class;
    }

    public function serialize(
        JsonSerializationVisitor $visitor,
        ConflictHttpException $exception,
        array $type,
        Context $context
    ): array {
        $violations = [];

        $previousException = $exception->getPrevious();
        if ($previousException instanceof NotUniqueException) {
            $violations[] = $this->normalizerService->normalizeConstraintViolation(
                $previousException->getConstraintViolation()
            );
        }

        return [
            'message' => $exception->getMessage(),
            'details' => $exception->getDetails(),
            'technicalCode' => $exception->getTechnicalCode(),
            'errorCode' => $exception->getErrorCode(),
            'violations' => $violations,
        ];
    }
}
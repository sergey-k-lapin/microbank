<?php

namespace App\Normalizer\Api\Exception;

use App\Exception\Api\Http\BadRequestHttpException;
use App\Exception\ConstraintViolationException;
use App\Normalizer\AbstractNormalizer;
use App\Service\NormalizerService;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Context;
use Symfony\Component\Validator\ConstraintViolation;

class BadRequestHttpExceptionNormalizer extends AbstractNormalizer
{
    protected NormalizerService $normalizerService;

    public function __construct(NormalizerService $normalizerService)
    {
        $this->normalizerService = $normalizerService;
    }

    protected static function getSerializationType(): ?string
    {
        return BadRequestHttpException::class;
    }

    public function serialize(
        JsonSerializationVisitor $visitor,
        BadRequestHttpException $exception,
        array $type,
        Context $context
    ): array {
        $violations = [];

        $previousException = $exception->getPrevious();
        if ($previousException instanceof ConstraintViolationException) {
            /** @var ConstraintViolation $constraintViolation */
            foreach ($previousException->getConstraintViolationList() as $constraintViolation) {
                $violations[] = $this->normalizerService->normalizeConstraintViolation($constraintViolation);
            }
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
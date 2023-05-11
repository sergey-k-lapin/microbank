<?php

namespace App\Service;

use App\Service\Util\StringService;
use Symfony\Component\Validator\ConstraintViolation;

class NormalizerService
{
    protected const UNRECOGNIZED_CODE = 'unrecognized-error-code';

    protected StringService $stringService;

    public function __construct(StringService $stringService)
    {
        $this->stringService = $stringService;
    }

    public function normalizeConstraintViolation(ConstraintViolation  $constraintViolation): array
    {
        $violationCode = $constraintViolation->getConstraint()->payload['violationCode'] ?? null;
        $violationCode = $violationCode
            ?? $this->buildConstraintViolationCodeByConstraintViolation($constraintViolation);

        return [
            'property' => $constraintViolation->getPropertyPath(),
            'message' => $constraintViolation->getMessage(),
            'technicalCode' => $constraintViolation->getCode(),
            'violationCode' => $violationCode,
        ];
    }

    protected function buildConstraintViolationCodeByConstraintViolation(
        ConstraintViolation $constraintViolation
    ): string {
        $violationCode = $constraintViolation->getConstraint()->payload['error_code'] ?? null;

        if (!$violationCode) {
            $propertyPath = $this->stringService->kebabCase($constraintViolation->getPropertyPath());

            if ($propertyPath) {
                $violationCode = sprintf('invalid-%s', $propertyPath);
            } else {
                $violationCode = self::UNRECOGNIZED_CODE;
            }
        }

        return $violationCode;
    }
}
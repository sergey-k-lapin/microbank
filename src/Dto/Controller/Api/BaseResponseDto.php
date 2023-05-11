<?php

namespace App\Dto\Controller\Api;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

class BaseResponseDto
{
    protected bool $result = true;

    /** @var ConstraintViolationListInterface|Throwable|null */
    protected $error = null;

    public function isResult(): bool
    {
        return $this->result;
    }

    public function setResult(bool $result): void
    {
        $this->result = $result;
    }

    /**
     * @return null|ConstraintViolationListInterface|Throwable
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param null|ConstraintViolationListInterface|Throwable $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }
}
<?php

namespace App\Api\Validations;

use \Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class Validation
{
    /**
     * @param string $value
     * @param string $field
     * @throws BadRequestHttpException
     */
    protected function isNotNull(string $value, string $field): void
    {
        if (!$value) {
            throw new BadRequestHttpException('The field `' . mb_strtoupper($field) . '` must not be empty');
        }
    }

    /**
     * @param string $pattern
     * @param string $value
     * @param string $field
     * @throws BadRequestHttpException
     */
    protected function isRegExp(string $pattern, string $value, string $field): void
    {
        if (!preg_match($pattern, $value)) {
            throw new BadRequestHttpException('Enter the correct field `' . mb_strtoupper($field) . '`');
        }
    }

    /**
     * @param string $value
     */
    protected function isEmail(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new BadRequestHttpException('Enter the correct email');
        }
    }
}

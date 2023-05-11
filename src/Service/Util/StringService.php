<?php

namespace App\Service\Util;

use Symfony\Component\String\UnicodeString;

class StringService
{
    protected const DEFAULT_RANDOM_STRING_LENGTH = 20;

    public function generateRandomPassword(int $length = self::DEFAULT_RANDOM_STRING_LENGTH): string
    {
        $alphabet='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($alphabet),0,$length);
    }

    public function generateRandomString(int $length = self::DEFAULT_RANDOM_STRING_LENGTH): string
    {
        $string = '';

        while (True) {
            $string .= uniqid();
            if (mb_strlen($string) >= $length) {
                break;
            }
        }

        return str_shuffle(mb_substr($string, 0, $length));
    }

    public function generateRandomDigitString(int $length = self::DEFAULT_RANDOM_STRING_LENGTH): string
    {
        $string = '';

        while (True) {
            $string .= rand(0, 9);
            if (mb_strlen($string) >= $length) {
                break;
            }
        }

        return str_shuffle(mb_substr($string, 0, $length));
    }

    public function snakeCase(string $string): string
    {
        return strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $string));
    }

    public function kebabCase(string $string): string
    {
        return strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '-$1', $string));
    }

    public function camelCase(string $string): string
    {
        return (new UnicodeString($string))->camel()->toString();
    }
}

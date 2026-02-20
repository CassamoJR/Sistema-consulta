<?php

declare(strict_types=1);

namespace App\Core;

final class Validator
{
    public static function sanitize(string $value): string
    {
        return trim($value);
    }

    public static function h(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

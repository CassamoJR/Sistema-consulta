<?php

declare(strict_types=1);

namespace App\Core;

final class Session
{
    public static function start(string $name): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        session_name($name);
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'httponly' => true,
            'secure' => isset($_SERVER['HTTPS']),
            'samesite' => 'Strict',
        ]);

        session_start();
    }

    public static function regenerate(): void
    {
        session_regenerate_id(true);
    }
}

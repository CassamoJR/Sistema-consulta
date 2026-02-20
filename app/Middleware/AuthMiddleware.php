<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;

final class AuthMiddleware
{
    public function handle(): bool
    {
        if (!Auth::check()) {
            header('Location: /admin/login');
            return false;
        }

        return true;
    }
}

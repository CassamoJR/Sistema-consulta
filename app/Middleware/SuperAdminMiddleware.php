<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;

final class SuperAdminMiddleware
{
    public function handle(): bool
    {
        $user = Auth::user();
        if (!$user || $user['perfil'] !== 'super_admin') {
            http_response_code(403);
            echo 'Acesso negado.';
            return false;
        }

        return true;
    }
}

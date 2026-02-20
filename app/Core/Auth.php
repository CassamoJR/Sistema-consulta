<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\Admin;

final class Auth
{
    public static function attempt(string $email, string $password): bool
    {
        $adminModel = new Admin();
        $admin = $adminModel->findByEmail($email);

        if (!$admin || !password_verify($password, $admin['password_hash'])) {
            return false;
        }

        Session::regenerate();
        $_SESSION['admin'] = [
            'id' => (int) $admin['id'],
            'nome' => $admin['nome'],
            'email' => $admin['email'],
            'perfil' => $admin['perfil'],
        ];

        return true;
    }

    public static function check(): bool
    {
        return isset($_SESSION['admin']);
    }

    public static function user(): ?array
    {
        return $_SESSION['admin'] ?? null;
    }

    public static function logout(): void
    {
        unset($_SESSION['admin']);
        Session::regenerate();
    }
}

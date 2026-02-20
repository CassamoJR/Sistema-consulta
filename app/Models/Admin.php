<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Admin extends Model
{
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM administradores WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch();

        return $admin ?: null;
    }
}

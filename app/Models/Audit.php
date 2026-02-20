<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Audit extends Model
{
    public function log(int $adminId, string $action, string $description): void
    {
        $stmt = $this->db->prepare('INSERT INTO auditoria (admin_id, accao, descricao, data_evento) VALUES (:admin_id, :accao, :descricao, NOW())');
        $stmt->execute([
            'admin_id' => $adminId,
            'accao' => $action,
            'descricao' => $description,
        ]);
    }
}

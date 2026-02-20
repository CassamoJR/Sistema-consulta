<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Contribution extends Model
{
    public function monthlyTotal(): float
    {
        $stmt = $this->db->query("SELECT COALESCE(SUM(valor), 0) FROM contribuicoes WHERE estado_pagamento='Pago' AND mes_referencia = MONTH(CURDATE()) AND ano_referencia = YEAR(CURDATE())");
        return (float) $stmt->fetchColumn();
    }

    public function yearlyTotal(): float
    {
        $stmt = $this->db->query("SELECT COALESCE(SUM(valor), 0) FROM contribuicoes WHERE estado_pagamento='Pago' AND ano_referencia = YEAR(CURDATE())");
        return (float) $stmt->fetchColumn();
    }

    public function byProvince(): array
    {
        $sql = "SELECT m.provincia, COALESCE(SUM(c.valor),0) AS total
                FROM membros m
                LEFT JOIN contribuicoes c ON c.membro_id = m.id AND c.estado_pagamento='Pago'
                GROUP BY m.provincia
                ORDER BY total DESC";

        return $this->db->query($sql)->fetchAll();
    }
}

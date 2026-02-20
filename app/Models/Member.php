<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Member extends Model
{
    public function create(array $data): bool
    {
        $sql = 'INSERT INTO membros (nome_completo, genero, data_nascimento, nivel_academico, area_formacao, ano_ingresso, provincia, distrito, zip, escola, contacto, estado, data_registo)
                VALUES (:nome_completo, :genero, :data_nascimento, :nivel_academico, :area_formacao, :ano_ingresso, :provincia, :distrito, :zip, :escola, :contacto, :estado, NOW())';

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    public function pending(): array
    {
        return $this->db->query("SELECT * FROM membros WHERE estado = 'Pendente' ORDER BY data_registo DESC")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM membros WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare('UPDATE membros SET estado = :estado WHERE id = :id');
        return $stmt->execute(['estado' => $status, 'id' => $id]);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = 'UPDATE membros SET nome_completo=:nome_completo, genero=:genero, data_nascimento=:data_nascimento, nivel_academico=:nivel_academico,
                area_formacao=:area_formacao, ano_ingresso=:ano_ingresso, provincia=:provincia, distrito=:distrito, zip=:zip, escola=:escola, contacto=:contacto
                WHERE id=:id';

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function overdueCount(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM membros m WHERE m.estado='Aprovado' AND NOT EXISTS (SELECT 1 FROM contribuicoes c WHERE c.membro_id = m.id AND c.ano_referencia = YEAR(CURDATE()) AND c.mes_referencia = MONTH(CURDATE()) AND c.estado_pagamento='Pago')")->fetchColumn();
    }
}

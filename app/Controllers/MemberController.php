<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Member;

final class MemberController extends Controller
{
    public function createForm(): void
    {
        $this->view('members/create', ['title' => 'Cadastro de Membro']);
    }

    public function store(): void
    {
        if (!Csrf::validate($_POST['_csrf'] ?? null)) {
            http_response_code(419);
            echo 'Token CSRF inválido.';
            return;
        }

        $data = [
            'nome_completo' => trim($_POST['nome_completo'] ?? ''),
            'genero' => trim($_POST['genero'] ?? ''),
            'data_nascimento' => trim($_POST['data_nascimento'] ?? ''),
            'nivel_academico' => trim($_POST['nivel_academico'] ?? ''),
            'area_formacao' => trim($_POST['area_formacao'] ?? ''),
            'ano_ingresso' => (int) ($_POST['ano_ingresso'] ?? 0),
            'provincia' => trim($_POST['provincia'] ?? ''),
            'distrito' => trim($_POST['distrito'] ?? ''),
            'zip' => trim($_POST['zip'] ?? ''),
            'escola' => trim($_POST['escola'] ?? ''),
            'contacto' => trim($_POST['contacto'] ?? ''),
            'estado' => 'Pendente',
        ];

        $errors = $this->validate($data);
        if ($errors !== []) {
            $this->view('members/create', ['title' => 'Cadastro de Membro', 'errors' => $errors, 'old' => $data]);
            return;
        }

        $model = new Member();
        $model->create($data);

        $this->view('members/success', ['title' => 'Cadastro submetido']);
    }

    private function validate(array $data): array
    {
        $errors = [];
        $currentYear = (int) date('Y');

        foreach (['nome_completo', 'genero', 'data_nascimento', 'nivel_academico', 'area_formacao', 'provincia', 'distrito', 'zip', 'escola', 'contacto'] as $field) {
            if ($data[$field] === '') {
                $errors[] = "O campo {$field} é obrigatório.";
            }
        }

        if ($data['ano_ingresso'] <= 0 || $data['ano_ingresso'] > $currentYear) {
            $errors[] = 'Ano de ingresso inválido.';
        }

        $birthTs = strtotime($data['data_nascimento']);
        if ($birthTs === false) {
            $errors[] = 'Data de nascimento inválida.';
        } else {
            $age = (int) date_diff(date_create(date('Y-m-d', $birthTs)), date_create('today'))->y;
            if ($age < 18 || $age > 80) {
                $errors[] = 'Idade fora da faixa plausível para docente.';
            }
        }

        if (!preg_match('/^\+?[0-9\-\s]{9,20}$/', $data['contacto'])) {
            $errors[] = 'Contacto inválido.';
        }

        return $errors;
    }
}

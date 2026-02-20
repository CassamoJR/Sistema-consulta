<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Audit;
use App\Models\Member;

final class AdminController extends Controller
{
    public function dashboard(): void
    {
        $model = new Member();
        $this->view('admin/dashboard', [
            'title' => 'Painel Administrativo',
            'pendingMembers' => $model->pending(),
            'user' => Auth::user(),
        ]);
    }

    public function approve(): void
    {
        $this->changeStatus('Aprovado', 'aprovação');
    }

    public function reject(): void
    {
        $this->changeStatus('Rejeitado', 'rejeição');
    }

    public function editForm(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $member = (new Member())->find($id);
        if (!$member) {
            http_response_code(404);
            echo 'Membro não encontrado.';
            return;
        }

        $this->view('admin/edit-member', ['title' => 'Editar Membro', 'member' => $member]);
    }

    public function update(): void
    {
        if (!Csrf::validate($_POST['_csrf'] ?? null)) {
            http_response_code(419);
            echo 'Token CSRF inválido.';
            return;
        }

        $id = (int) ($_POST['id'] ?? 0);
        $payload = [
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
        ];

        (new Member())->update($id, $payload);
        $admin = Auth::user();
        (new Audit())->log((int) $admin['id'], 'editar_membro', "Membro {$id} foi actualizado");

        $this->redirect('/admin');
    }

    private function changeStatus(string $status, string $actionLabel): void
    {
        if (!Csrf::validate($_POST['_csrf'] ?? null)) {
            http_response_code(419);
            echo 'Token CSRF inválido.';
            return;
        }

        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/admin');
        }

        (new Member())->updateStatus($id, $status);
        $admin = Auth::user();
        (new Audit())->log((int) $admin['id'], $actionLabel, "Membro {$id} alterado para {$status}");

        $this->redirect('/admin');
    }
}

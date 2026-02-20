<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index', [
            'title' => 'ANAPRO - Página inicial',
            'news' => [
                'Novo calendário de formação contínua para docentes.',
                'Ministério da Educação reforça programa de supervisão pedagógica.',
                'ANAPRO anuncia campanha de adesão nacional 2026.',
            ],
        ]);
    }
}

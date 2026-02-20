<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = []): void
    {
        $viewFile = __DIR__ . '/../../views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            http_response_code(404);
            echo 'View não encontrada';
            return;
        }

        extract($data, EXTR_SKIP);
        $config = require __DIR__ . '/../../config/config.php';
        require __DIR__ . '/../../views/layouts/main.php';
    }
}

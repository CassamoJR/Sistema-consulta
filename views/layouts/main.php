<?php

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Validator;

?><!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Validator::h($title ?? $config['app_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">ANAPRO</a>
        <div class="navbar-nav ms-auto gap-2">
            <a class="nav-link" href="/membros/cadastro">Cadastro</a>
            <?php if (Auth::check()): ?>
                <a class="nav-link" href="/admin">Admin</a>
                <form method="POST" action="/admin/logout">
                    <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
                    <button class="btn btn-sm btn-light">Sair</button>
                </form>
            <?php else: ?>
                <a class="nav-link" href="/admin/login">Login Administrativo</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="container py-4">
    <?php require $viewFile; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

declare(strict_types=1);

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\FinancialController;
use App\Controllers\HomeController;
use App\Controllers\MemberController;
use App\Middleware\AuthMiddleware;

$router->get('/', [HomeController::class, 'index']);
$router->get('/membros/cadastro', [MemberController::class, 'createForm']);
$router->post('/membros/cadastro', [MemberController::class, 'store']);

$router->get('/admin/login', [AuthController::class, 'loginForm']);
$router->post('/admin/login', [AuthController::class, 'login']);
$router->post('/admin/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

$router->get('/admin', [AdminController::class, 'dashboard'], [AuthMiddleware::class]);
$router->post('/admin/membro/aprovar', [AdminController::class, 'approve'], [AuthMiddleware::class]);
$router->post('/admin/membro/rejeitar', [AdminController::class, 'reject'], [AuthMiddleware::class]);
$router->get('/admin/membro/editar', [AdminController::class, 'editForm'], [AuthMiddleware::class]);
$router->post('/admin/membro/editar', [AdminController::class, 'update'], [AuthMiddleware::class]);

$router->get('/admin/financeiro', [FinancialController::class, 'dashboard'], [AuthMiddleware::class]);
$router->get('/api/financeiro/resumo', [FinancialController::class, 'apiSummary'], [AuthMiddleware::class]);
$router->get('/admin/financeiro/export/pdf', [FinancialController::class, 'exportPdf'], [AuthMiddleware::class]);
$router->get('/admin/financeiro/export/excel', [FinancialController::class, 'exportExcel'], [AuthMiddleware::class]);

<?php

declare(strict_types=1);

use App\Core\Csrf;
use App\Core\Router;
use App\Core\Session;

require_once __DIR__ . '/../app/bootstrap.php';

$config = require __DIR__ . '/../config/config.php';
Session::start($config['session_name']);
Csrf::token();

$router = new Router();
require __DIR__ . '/../routes/web.php';
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

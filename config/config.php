<?php

declare(strict_types=1);

return [
    'app_name' => getenv('APP_NAME') ?: 'ANAPRO',
    'app_url' => getenv('APP_URL') ?: 'http://localhost:8000',
    'session_name' => getenv('SESSION_NAME') ?: 'ANAPRO_SESSION',
];

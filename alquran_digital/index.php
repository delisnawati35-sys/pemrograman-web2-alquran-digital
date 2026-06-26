<?php

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// HOME
if ($request === '/' || $request === '') {
    require __DIR__ . '/frontend/index.php';
    exit;
}

// AUTH / FRONTEND
if (str_starts_with($request, '/auth')) {
    require __DIR__ . '/auth/login.php';
    exit;
}

// BACKEND API
if (str_starts_with($request, '/api')) {
    require __DIR__ . '/backend-api/update.php';
    exit;
}

// DASHBOARD
if ($request === '/dashboard') {
    require __DIR__ . '/frontend/dashboard.php';
    exit;
}

http_response_code(404);
echo "404 Not Found";
<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/table' && $requestMethod === 'GET') {

    require_once __DIR__ . '/table.php';

} elseif ($requestUri === '/login' &&
          ($requestMethod === 'GET' || $requestMethod === 'POST')) {

    require_once __DIR__ . '/login.php';

} elseif ($requestUri === '/logout' && 
          ($requestMethod === 'GET' || $requestMethod === 'POST')) {

    require_once __DIR__ . '/logout.php';

} elseif ($requestUri === '/newUser' &&
          ($requestMethod === 'GET' || $requestMethod === 'POST')) {

    require_once __DIR__ . '/newUser.php';

} else {

    http_response_code(404);
    echo '404 Not Found';
}
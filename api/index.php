<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$tmp = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];
foreach ($tmp as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

$env = [
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
    'APP_CONFIG_CACHE'   => '/tmp/bootstrap/cache/config.php',
    'APP_ROUTES_CACHE'   => '/tmp/bootstrap/cache/routes.php',
    'APP_EVENTS_CACHE'   => '/tmp/bootstrap/cache/events.php',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
];
foreach ($env as $k => $v) {
    putenv("$k=$v");
    $_ENV[$k] = $v;
    $_SERVER[$k] = $v;
}

try {
    require __DIR__ . '/../public/index.php';
} catch (Throwable $e) {
    http_response_code(500);
    echo '<pre>' . get_class($e) . ': ' . $e->getMessage() . "\n" . $e->getFile() . ':' . $e->getLine() . '</pre>';
}

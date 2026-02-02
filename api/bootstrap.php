<?php
// API Bootstrap
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Controller.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

session_start();

// Load environment variables
\App\Core\Env::load(__DIR__ . '/../.env');

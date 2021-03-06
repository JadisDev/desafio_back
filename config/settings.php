<?php

define('APP_ROOT', __DIR__ . "/../");

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,
        'doctrine' => [
            'dev_mode' => $_ENV['DEV_MODE'],
            'cache_dir' => APP_ROOT . 'var/doctrine',
            'metadata_dirs' => [APP_ROOT . 'src/Entities'],
            'connection' => [
                'driver' => $_ENV['DB_DRIVER'],
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'dbname' => $_ENV['DB_DATABASE'],
                'user' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'charset' => 'utf8mb4'
            ]
        ]
    ]
];

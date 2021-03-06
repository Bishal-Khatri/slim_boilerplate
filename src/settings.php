<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
//        'db' => [
//            'driver' => getenv('DB_CONNECTION','mysql'),
//            'host' => getenv('DB_HOST','localhost'),
//            'database' => getenv('DB_NAME','db_name'),
//            'username' => getenv('DB_USER','db_user'),
//            'password' => getenv('DB_PASSWORD','db_password'),
//            'charset'   => 'utf8',
//            'collation' => 'utf8_unicode_ci',
//            'prefix'    => '',
//        ],
        'mongodb' => [
            'driver'   => 'mongodb',
            'host'     => env('DB_HOST', 'localhost'),
            'port'     => env('DB_PORT', 27017),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'options'  => [
                'database' => 'admin' // sets the authentication database required by mongo 3
            ]
        ],
    ],
];

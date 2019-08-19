<?php
date_default_timezone_set('Asia/Kathmandu');
require "../vendor/larapack/dd/src/helper.php";

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create('../');
$dotenv->load();

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);


$container = $app->getContainer();
//boot eloquent connection

$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['mongodb']);

$capsule->setAsGlobal();

$capsule->bootEloquent();
//pass the connection to global container (created in previous article)

$container['db'] = function ($container) use ($capsule){

    return $capsule;

};

$container['TestController'] = function ($container) {
    return new \App\TestController($container);

};

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
$app->register(Jenssegers\Mongodb\MongodbServiceProvider::class);

$app->withEloquent();
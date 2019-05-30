<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Controllers\TestController;

$app->get('/all', TestController::class . ':index');
$app->post('/add', TestController::class . ':store');
$app->get('/test', TestController::class . ':test');

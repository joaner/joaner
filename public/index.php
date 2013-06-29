<?php

define('BASE_DIR', realpath('..'));


use \core\autoload;
use \core\request;
use \core\response;
use \core\config;


require BASE_DIR. '/core/autoload.php';
autoload::init();

new config('main');

$request = new request();
$request->run();

$controller = new $request->controller;
$controller->run();

$response = new response($controller);
$response->run();

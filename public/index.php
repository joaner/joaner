<?php

define('BASE_DIR', realpath('..'));


use \core\autoload;
use \core\request;
use \core\response;
use \core\config;

use \core\exception\fileException;
use \core\exception\paramException;


require BASE_DIR. '/core/autoload.php';
autoload::init();

try{

	new config('main.php');

	$request = new request();
	$controller = $request->run();

	$controller->run();

	$response = new response($controller);
	$response->run();

}catch(Exception $e){
	echo $e;
}catch(fileException $e){
	echo $e;
}

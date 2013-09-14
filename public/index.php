<?php

// define('BASE_DIR', realpath('..'));
define('BASE_DIR', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : realpath('..'));
define('TEMP_DIR', sys_get_temp_dir());

define('WORK', 'product');

use \core\autoload;
use \core\request;
use \core\response;
use \core\config;

use \core\exception\fileException;
use \core\exception\paramException;


require BASE_DIR. '/core/autoload.php';
autoload::init();

try{
	config::init('main.xml');

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

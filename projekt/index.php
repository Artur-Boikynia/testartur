<?php
declare(strict_types=1);
error_reporting(E_ALL);
$configs = require_once __DIR__ . '/configs/config.php';
use app\components\App;

require_once __DIR__ . '/vendor/autoload.php';

App::runApp($configs);

var_dump($_SERVER['REQUEST_METHOD']);
//$index = new \app\components\Dispatcher($_SERVER['REQUEST_URI']);
//$router = new \app\components\Router($index);

//var_dump($_SERVER['REQUEST_URI']);
//var_dump($_GET);



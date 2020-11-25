<?php
error_reporting(E_ALL);
require_once __DIR__ .'/security.php';
require_once __DIR__ .'/views/categories/mainScreen.php';
require_once __DIR__ . '/lib/Connecttodb.php';
$config = require __DIR__ . '/config.php';
require_once __DIR__ . '/lib/PrepareableInterface.php';
require_once __DIR__ . '/lib/Dispatcherclass.php';

mainScreen::getScreen();
Connecttodb::SetDb();

$page = new Dispatcherclass($_SERVER['REQUEST_URI'],$config);

?>


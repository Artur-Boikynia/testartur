<?php
session_start();
$config = require_once __DIR__ .'/config.php';
$webWay = rtrim($config['webRout'],'/');

$isUser = !isset($_SESSION['user']);
$wayToForm =  $webWay . '/Login_v3/formauthor.php';

if ($isUser) {
    header("Location: {$wayToForm}");
    exit();
}

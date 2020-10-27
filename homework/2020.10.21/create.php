<?php
$baseDir = $_POST['baseDir'] ?? null;
$nameDir = $_POST['newDirectory'];

if (!$baseDir || !$nameDir){
    exit('You dont input name of Dir');
}

$config = require_once __DIR__ . '/config.php';

$makeRout = rtrim($config['baseDir']). '/' .rtrim($baseDir)  . '/' . trim($nameDir);

mkdir($makeRout);

header("Location: index.php?rout={$baseDir}");
exit;




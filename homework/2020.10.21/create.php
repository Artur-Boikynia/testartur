<?php
$baseDir = $_POST['baseDir'] ?? null;
$nameDir = $_POST['newDirectory'];

if (!$baseDir || !$nameDir){
    exit('You dont input name of Dir');
}

$rout = rtrim($baseDir,'/') . '/' . ltrim($nameDir);

mkdir($rout);

$arrayBaseDir = explode('/', ltrim($baseDir,'/'));
$getParameters = array_filter($arrayBaseDir, static function($key){
    if($key === 0 || $key === 1 || $key === 2 || $key === 3 || $key === 4){
        return false;
    }
    else {
        return true;
    }
},ARRAY_FILTER_USE_KEY);

$getParameters = '/' . trim(implode('/', $getParameters), '/');

header("Location: index.php?rout={$getParameters}");
exit;




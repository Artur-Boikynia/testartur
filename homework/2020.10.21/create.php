<?php
$baseDir = $_POST['baseDir'] ?? null;
$nameDir = $_POST['newDirectory'];
if (!$baseDir || !$nameDir){
    exit('You dont input name of Dir');
}

$rout = rtrim($baseDir,'/') . '/' . ltrim($nameDir);

mkdir($rout);

header("Location: index.php?rout={$baseDir}");
exit;




<?php
$config = require __DIR__ . '/config.php';

function invertArray(array $filePost) : array
{
    $fileArray = [];
    $count = count($filePost['name']);
    $fileKeys = array_keys($filePost);

    for ($i = 0; $i < $count; $i++) {
        foreach ($fileKeys as $key) {
            $fileArray[$i][$key] = $filePost[$key][$i];
        }
    }

    return $fileArray;
}
$attachment = isset($_FILES['attachment']) ? invertArray($_FILES['attachment']) : null;
$insideDir = $_POST['baseDir'] ?? '';

if (!$attachment) {
    exit('Uploading can not be completed');
}

foreach ($attachment as $value){
    $rout = sprintf(
        '%s/%s/%s',
        rtrim($config['baseDir'],'/'),
        rtrim($insideDir,'/'),
        trim($value['name'])

    );
    move_uploaded_file($value['tmp_name'], $rout);
}


header("Location: index.php?rout={$insideDir}");
exit;


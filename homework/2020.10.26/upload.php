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

if(count($attachment) > 2){                                                         // Limit of quantity selected files. LIMIT: max $i = 2 - files;
    exit("You have exceeded limit of quantity selected files (LIMIT: max 2 files)");
}

$arrayOfForbiddenTypes = [
    'image/png',
];

for ($i = 0; $i < count($attachment); $i++ ){
    if($attachment[$i]['size'] > 1e6){                                      // size of file must to be under then 1 MB
       exit("File {$attachment[$i]['name']} is too large. Choose another file with size under 1 MB");
    }
    if(in_array($attachment[$i]['type'], $arrayOfForbiddenTypes)){
        exit("type {$attachment[$i]['type']} does not fit");
    }
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


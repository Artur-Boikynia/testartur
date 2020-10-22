<?php

require_once __DIR__.'/myfunction.php';

$button3 = $_REQUEST['editSub'] ?? null;
$messageEdit = $_POST['messageedit'];

if(!isset($button3)){
    exit(' Any button was not pressed');
}

if (!$messageEdit) {
    exit('Some data was not entered');
}

$messages = [];
$file = fopen(__DIR__ . '/storage', 'rb');
while ($line = fgets($file, 1024)) {
    $messages[] = json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);
}

removingBadWords($lib, $messageEdit);

foreach ( $messages as $key => $value){
    if($value['id'] == $button3){
        $messages[$key]['message'] = $messageEdit;
    }
}

file_put_contents(__DIR__ . '/storage', '');

uasort($messages, mySort('id'));
foreach ($messages as $k => $v) {
    $content = json_encode($v, JSON_THROW_ON_ERROR) . PHP_EOL;
    file_put_contents(__DIR__ . '/storage', $content, FILE_APPEND);
}
header('Location: /homework/2020.10.19');
exit;
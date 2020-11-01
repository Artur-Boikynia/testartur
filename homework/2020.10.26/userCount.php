<?php
session_start();

require_once __DIR__ .'/security.php';

define('TODAY_DATE' , date('Y-m-d') );
define('TODAY_TIME' , time());

$messages = [];
$file = fopen(__DIR__ . '/stat.txt', 'rb');
while ($line = fgets($file, 1024)) {
    $messages = json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);

}
fclose($file);

if(filesize(__DIR__ . '/stat.txt') === 0){
    $bufferArray = [
        'username' => $_SESSION['user'],
        'count' => 1,
        'visit' => date('Y-m-d',TODAY_TIME),
    ];
    $generalArray[] = $bufferArray;
}
else{
    for($k = 0; $k<count($messages); $k++){
        $libName[] = $messages[$k]['username'];
        $generalArray[] = $messages[$k];
    }
    if(in_array($_SESSION['user'],$libName) === false){
        $bufferArray = [
            'username' => $_SESSION['user'],
            'count' => 1,
            'visit' => date('Y-m-d',TODAY_TIME),
        ];
        $generalArray[] = $bufferArray;
    }
     else{
        for ($i = 0; $i<count($generalArray); $i++){
            if($generalArray[$i]['username'] === $_SESSION['user']){
                if($generalArray[$i]['visit'] === TODAY_DATE){
                    $generalArray[$i]['count']++;
                }
                else{
                    $generalArray[$i]['count'] = 1;
                    $generalArray[$i]['visit'] = TODAY_DATE;
                }
            }
        }
     }
}

$filtredArray = array_filter($generalArray, static function($element){
    if($element['visit'] === TODAY_DATE ){
        return true;
    }
    else{
        return false;
    }
});

sort($filtredArray);

$file = fopen(__DIR__ . '/stat.txt', 'a+b');
ftruncate($file, 0);
fclose($file);

$content = json_encode($filtredArray, JSON_THROW_ON_ERROR) . PHP_EOL;
file_put_contents(__DIR__ . '/stat.txt', $content, FILE_APPEND);



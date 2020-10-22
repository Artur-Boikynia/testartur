<?php
require_once __DIR__.'/myfunction.php';

$firstName = $_POST['firstname'] ?? null;
$secondName = $_POST['secondname'] ?? null;
$message = $_POST['message'] ?? null;
$radio = $_POST['gridRadios'] ?? null;
$email = $_POST['email'] ?? null;
$button = $_POST['submit'] ?? null;

if (!$button) {
    exit('The form was not submitted');
}

if (!$firstName || !$secondName || !$message || !$radio || !$email) {
    exit('Some data was not entered');
}

if(stripos($email, '.') === false ||stripos($email, '@') === false ){
    exit('You entered the wrong email');
}

if (file_exists('storage') && !empty(file_get_contents(__DIR__.'/storage') )){
    $messages = [];
    $file = fopen(__DIR__ . '/storage', 'rb');
    while ($line = fgets($file, 1024)) {
        $messages[] = json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);
    }
    uasort($messages, mySort('id'));                   //   sorts by ID
    end($messages);
    (int) $keyOfLastElement = key($messages);
    $keyOfLastElement++;
}

else{
    $keyOfLastElement = 0;
}

$lib =[
    'fuck',
    'nigger',
    'bitch',
    'asshole',
    'retard',
    'fuck you',
    'jerk',
    'sucker',
];

removingBadWords($lib, $message);

$data = [
    'id' => $keyOfLastElement,
    'firstname' => $firstName,
    'secondname' => $secondName,
    'email' => $email,
    'message' => nl2br($message),
    'date' => date('Y-m-d H:i:s'),

];

$content = json_encode($data, JSON_THROW_ON_ERROR) . PHP_EOL;
file_put_contents(__DIR__ . '/storage', $content, FILE_APPEND);
header('Location: /homework/2020.10.19');
exit;
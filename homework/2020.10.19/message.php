<?php
/**
 * This function finds words in string from library and changs this words on "****"
 * * @param array $lib
 * * @param string $message
 * @return void
 *
 */
function removingBadWords(array $lib, string &$message):void{
    foreach ($lib as $key => $value){
        if(stripos($message, $value) !== false){
            $beginningOfWord = stripos($message, $value);
            $wordLenght = strlen($value);
            $placeOfWord = $beginningOfWord + $wordLenght;
            for ($beginningOfWord; $beginningOfWord < $placeOfWord ; $beginningOfWord++){
                $message[$beginningOfWord] = '*';
            }
            removingBadWords($lib, $message);
        }
        else{
            continue;
        }
    }
}

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
//print_r($message);

$data = [
    'firstname' => $firstName,
    'secondname' => $secondName,
    'email' => $email,
    'message' => nl2br($message),
    'date' => date('Y-m-d H:i:s')
];

$content = json_encode($data, JSON_THROW_ON_ERROR) . PHP_EOL;
file_put_contents(__DIR__ . '/storage', $content, FILE_APPEND);
header('Location: /homework/2020.10.19');
exit;
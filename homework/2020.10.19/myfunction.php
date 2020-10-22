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


function mySort ($key){
    return function ($a, $b) use ($key){
        return $a[$key] <=> $b[$key];
    };
}
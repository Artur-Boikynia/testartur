<?php


namespace app\components;


class Chat
{

    public function sendHeaders(string $headersText){
        $headers = [];
        $tmpLine = preg_split("/\r\n/", $headersText);

        foreach ($tmpLine as $line){
            $line = trim($line);
        }
    }
}
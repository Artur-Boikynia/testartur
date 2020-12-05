<?php


namespace app\helper;

/**
 * Class getParts
 * @package app\helper
 */
class getParts
{
    /**
     * @param string $uri
     * @param string $delimiter
     * @return array
     */
    public static function getController(string $uri, string $delimiter = '/'):array{
        $number= stripos($uri, '?');
        if($number !== false){
            $controllerPart = substr($uri,0,$number);
            $controllerPart = trim($controllerPart, " \t\n\r\0\x0B{$delimiter}");
            return explode('/', $controllerPart);
        }
        else{
            $controllerPart = trim($uri, " \t\n\r\0\x0B{$delimiter}");
            return explode('/', $controllerPart);
        }
    }
}
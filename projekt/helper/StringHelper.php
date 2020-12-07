<?php


namespace app\helper;


use app\exceptions\InvalidException;

class StringHelper
{
    public static function camelcase(string $notCamelCase, $delimiter ='-'):string{
        $camelCase = trim($notCamelCase);
        $camelCase = ucwords($camelCase," \t\r\n\f\v{$delimiter}");

        return str_replace($delimiter, '', $camelCase);

    }

    public static function tracerArray(string $searchString, array $config, $delimiter = '.'):string{
        $explodedArray = explode($delimiter, $searchString);
        foreach($explodedArray as $value){
            $config = $config[$value]?? null;
            if($config === null){
                throw new InvalidException('Value was not found');
            }
        }
        return $config;
    }
}
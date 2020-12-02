<?php

namespace app\helpers;

/**
 * Class StringsHelper
 * @package app\helpers
 */
class StringsHelper
{
    /**
     * @param string $subject
     * @param string $symbols
     * @return string
     */
    public static function trim(string $subject, string $symbols = ''): string
    {
        return trim($subject, " \t\n\r\0\x0B{$symbols}");
    }

    /**
     * @param string $name
     * @param string $delimiter
     * @return string
     */
    public static function camelize(string $name, string $delimiter = '-'): string
    {
        $processedName = ucwords($name, $delimiter);
        return str_replace('-', '', $processedName);
    }

    /**
     * @param array $params
     */
    public static function arrayToLowRegister(array &$params):void{
        if (!empty($params)){
            foreach ($params as $key => $value ){
                $key = mb_strtolower($key);
                $value = mb_strtolower($value);
                $newParams[$key] = $value;
            }
            $params = $newParams;
        }
    }

    /**
     * @param string $param
     */
    public static function stringToLowRegister (string &$param):void{
        $param = mb_strtolower($param);
    }
}

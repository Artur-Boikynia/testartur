<?php
namespace lib;

interface PrepareableInterface
{
    /**
     * @param string $url
     * @param array $config
     * @return array
     */
    public function prepareParts(string $url, array $config): array;

    /**
     * @return string
     */
    public function prepareFunctions():string;

    /**
     * @param string $function
     */
    public function startFunction (string $function):void;

}
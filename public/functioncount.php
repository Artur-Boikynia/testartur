<?php
declare(strict_types = 1);

$staff = [
    'phpDev' => 'Artur Boikynia',
    'jsDev' => 'Oleh Yakovlev',
     0 => 'Ivan Prokopchuk',
     1 => 'Denys Boyko',
    'fbAdvertisement' => 'Yaroslav Tokarev',
    'instagramAdvertisement' => 'Oleksandr Kravchenko',
    'telegramAdvertisement' => [
        'owner' => 'Olha Pavlova',
        'taskStatus' => ' not started',
        '0' => 1,
    ],
];

/**
 * This function counts the number of elements in an array (include nested elements)
 * if $nested = true INCLUDE nested elements (default $nested = true  ),
 * if $nested = false WITHOUT nested elements, in this case works like a PHP-function count()
 * * @param array $array
 * * @param bool $nested
 * @return int
 *
 */
function myCount(array $array, bool $nested = true):int{
    static $i = 0 ;
    foreach ($array as $k => $v){
        if(is_array($v) && $nested === true){
            myCount($v);
        }
        $i++;
    }
    return $i ;
}

var_dump(myCount($staff));
var_dump(count($staff));


<?php
declare(strict_types = 1);
$count1 = 0;
function power(int $number, int $power)
{
    global $count1;
    $count1++;

    if ($power === 0 || $number === 1) {
        return 1;
    }
    if ($power === 1 || $number === 0) {
        return $number;
    }
    if($power % 2 == 0){
        $powerDivided = power ($number, $power/2);
        return $powerDivided *  $powerDivided;
    }

    return $number * power($number, $power - 1);
}

$Recursive = power(5, 10);
var_dump($Recursive);
var_dump($count1);
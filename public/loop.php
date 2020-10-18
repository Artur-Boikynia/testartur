<?php
//$count = 0;
//function power (int $number , int $power ){
//    global $count;
//    $count++;
//    static $lib = [];
//    if ( array_key_exists($power, $lib)){
//        return $lib[$power];
//    }
//    if ($power === 0 || $number === 1 ){
//        return 1;
//    }
//    if($power === 1 || $number === 0){
//        return $number;
//    }
//    if(true){
//        $i=2;
//        $sum = $number;
//        while ($i < $power){
//            $sum = $sum * $number;
//            $lib[$i] = $sum;
//            $i++;
//        }
//    }
//    return $number * power($number, $power - 1);
//}

/** Working variant for function power() */
/*$count1 = 0;
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

$Recursive = power(5, 100);
var_dump($Recursive);
var_dump($count1);*/






//$count = 0;
//function power1(int $number, int $power)
//{
//    global $count;
//    $count++;
//    if ($power === 0 || $number === 1) {
//        return 1;
//    }
//    if ($power === 1 || $number === 0) {
//        return $number;
//    }
//
//    return $number * power1($number, $power - 1);
//}
//$powRecursive = power1(5, 100);
//var_dump($powRecursive, $count);





/*$count = 0;
function factorials($n){
    global $count;
    $count++;
    if($n == 0){
        return 1;
    }
    if($n == 1){
        return 1;
    }
    return $n * factorials($n - 1);
};

$powRecursive = factorials(5);
var_dump($powRecursive);
var_dump($count);*/



//$staff = [
//    'phpDev' => 'Artur Boikynia',
//    'jsDev' => 'Oleh Yakovlev',
//    'seoDev' => 'Ivan Prokopchuk',
//    'videoMaker' => 'Denys Boyko',
//    'fbAdvertisement' => 'Yaroslav Tokarev',
//    'instagramAdvertisement' => 'Oleksandr Kravchenko',
//    'taskOwner' => 'Artur Boikynia',
//
//];



$staff = [
    'taskOwner' => [
        'fbA' => 'Boikynia',
        'instagram' => 'Oleksandr Kravchenko',
    ],
    'phpDev' => 'Artur Boikynia',
    'jsDev' => 'Oleh Yakovlev',
    'seoDev' => 'Ivan Prokopchuk',
    'videoMaker' => 'Denys Boyko',
    'fbAdvertisement' => 'Yaroslav Tokarev',
    'instagramAdvertisement' => 'Oleksandr Kravchenko',
    ];




   $taskManager = [
        [
            'id' => 1,
            'taskTitle' => 'Websit development',
            'taskDescription' => 'Back-end and front-end development for a website',
            'taskOwner' => [
                'owner1' => $staff['phpDev'],
                'owner2' => $staff['jsDev'],
            ],
            'taskDeadline' => '20.12.2020 until 20:00 pm',
            'taskStatus' => 'started',
            'subtask' => [
                [
                    'id' => 1.1,
                    'taskTitle' => 'Back-end development',
                    'taskDescription' => 'Back-end development for a website',
                    'taskOwner' => $staff['phpDev'],
                    'taskDeadline' => '20.12.2020 until 20:00 pm',
                    'taskStatus' => 'started',
                ],
                [
                    'id' => 1.2,
                    'taskTitle' => 'Front-end development',
                    'taskDescription' => ' Basic front-end development for a website',
                    'taskOwner' => $staff['jsDev'],
                    'taskDeadline' => '01.12.2020 until 20:00 pm',
                    'taskStatus' => ' not started',
                ],
            ],
        ],
        [
            'id' => 2,
            'taskTitle' => 'SEO development',
            'taskDescription' => 'SEO development for this site',
            'taskOwner' => $staff['seoDev'],
            'taskDeadline' => '01.02.2021 until 20:00 pm',
            'taskStatus' => 'not started',
        ],
        [
            'id' => 3,
            'taskTitle' => 'Marketing',
            'taskDescription' => 'Advertising of products, that is selling on the site',
            'taskOwner' => [
                'owner1' => $staff['videoMaker'],
                'owner2' => $staff['fbAdvertisement'],
                'owner3' => $staff['instagramAdvertisement'],
                'owner4' => $staff['telegramAdvertisement'],
            ],
            'taskDeadline' => '1.03.2020 until 20:00 pm',
            'taskStatus' => 'started',
            'subtask' => [
                [
                    'id' => 3.1,
                    'taskTitle' => 'TV commercial',
                    'taskDescription' => 'Make a video clip',
                    'taskOwner' => $staff['videoMaker'],
                    'taskDeadline' => '01.11.2020 until 20:00 pm',
                    'taskStatus' => 'started',
                ],
                [
                    'id' => 3.2,
                    'taskTitle' => 'SMM',
                    'taskDescription' => 'Social media advertising',
                    'taskOwner' => [
                        'owner2' => $staff['fbAdvertisement'],
                        'owner3' => $staff['instagramAdvertisement'],
                        'owner4' => $staff['telegramAdvertisement'],
                    ],
                    'socialMedia' => [
                        'Facebook' => $staff['fbAdvertisement'],
                        'Instagram' => $staff['instagramAdvertisement'],
                        'Telegram' => $staff['telegramAdvertisement'],
                    ],
                    'taskDeadline' => 'not yet defined',
                    'taskStatus' => ' not started',
                ],
            ],

        ],
    ];




//$text = '';
//Successful task
//var_dump(count($staff));
/** if $nested = true INCLUDE nested elements (default $nested = true  ),
/** if $nested = false WITHOUT nested elements (default $nested = true  ),
 *
 */
/*function myCount(array $array, bool $nested = true){
    static $i = 0 ;
    foreach ($array as $k => $v){
        if(is_array($v) && $nested === true){
            myCount($v);
        }
        $i++;
    }
    return $i ;
};
var_dump(count($staff));
var_dump(myCount($staff, true));*/


/*function myPrint($print){
     $i = '' ;
    if(is_array($print)){
        foreach ($print as $k => $v){
            if(is_array($v)){
                $i .= 'ARRAY'. myPrint($v);
                echo $i;
            }
            else{
                $i.=  '  ' . $k . ' => ' . $v . '<br>';
                echo $i;
                unset($i);
            }
        }
    }
//   echo $print;
}*/




/*$lib = [];

$count = 0;
function myPrint($print)
{
    global $count;
    $count++;
    $i = '';
    if(is_array($print) === false){
//       echo $print . '<br>';
    }
    elseif (is_array($print)){
        echo  'Array(' . '<br>';
        foreach ($print as $key => $value) {
            $i .= $key . '=>' . $value . '<br>';
            echo $i;
            unset($i);
            if(is_array($value)){
                myPrint($value);
            }
        }
        echo  ')' . '<br>';
    }
}*/


/*$lib = [];

$count = 0;
function myPrint($print)
{
    global $count;
    $count++;
    $i = '';
    if(is_array($print) === false){
//       echo $print . '<br>';
    }
    elseif (is_array($print)){
        echo  'Array(' . '<br>';
        foreach ($print as $key => $value) {
            $i .= $key . '=>' . $value . '<br>';
            echo $i;
            unset($i);
            if(is_array($value)){
                myPrint($value);
            }
        }
        echo  ')' . '<br>';
    }
}*/


function myPrint($print):void
{
    global $count;
    $count++;
    $i = '';
    if (is_array($print)){
        echo  'Array(' . '<br>';
        foreach ($print as $key => $value) {
            $i .= $key . '=>' . $value . '<br>';
            echo $i;
            unset($i);
            if(is_array($value)){
                myPrint($value);
            }
        }
        echo  ')' . '<br>';
    }
    else{
        echo $print;
    }
}

$text = 'Texts';

myPrint($staff);
//var_dump($count);
//print_r($staff);











/*$count = 0;
function fib($n){
    static $lib = [];
    global $count;
    $count++;
    if($n === 0){
        return 0;
    }
    if($n === 1){
        return 1;
    }
    if(array_key_exists($n,$lib)){
     return $lib[$n];
    };
    $index1 = $n-2;
    $number1 = fib($index1);
    $lib[$index1] = $number1;
    $index2 = $n-1;
    $number2 = fib($index2);
    $lib[$index2] = $number2;
    return $number1 + $number2;
}

print_r(fib(50));
print_r($count);*/
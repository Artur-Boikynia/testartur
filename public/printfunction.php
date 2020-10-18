<?php
declare(strict_types = 1);
$staff = [
    'phpDev' => 'Artur Boikynia',
    'jsDev' => 'Oleh Yakovlev',
    'seoDev' => 'Ivan Prokopchuk',
    'videoMaker' => 'Denys Boyko',
    'fbAdvertisement' => 'Yaroslav Tokarev',
    'instagramAdvertisement' => 'Oleksandr Kravchenko',
    'telegramAdvertisement' => 'Olha Pavlova',
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

/**
 * This function prints elements, it works like PHP-function print_r().
 * But for comfort this function outputs arrays as COLUMNS.
 * if $nested = true INCLUDE nested elements (default $nested = true  ),
 * if $nested = false WITHOUT nested elements, in this case works like a PHP-function count()
 * * @param mixed $print
 * @return void
 *
 */


function myPrint($print):void
{
    global $count;
    $count++;
    $i = '';
    if (is_array($print)){
        echo  '(' . '<br>';
        foreach ($print as $key => $value) {
            $i .= '[' . $key . ']' . '=>' . $value . '<br>';
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

$text = 'Text for checking function';

myPrint($taskManager);
print_r($taskManager);
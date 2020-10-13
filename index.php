<?php
//error_reporting(E_ALL);
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
$tab = '';
$tab1 = '';
foreach ($taskManager as $key => $value){
    if (is_array($value)){
        foreach ($value as $k => $v){
            if (is_array($v)){
                $tab.= "<pre><pre class='font v'>$k</preid></pre>";
                foreach ($v as $k1 => $v1){
                    if(is_array($v1)){
                        $tab.= "<pre><pre class='font v1'> $k1</preid></pre>";
                        foreach ($v1 as $k2 => $v2){
                            $tab.= "<pre><pre class='font v2'> $k2 : $v2</preid></pre>";
                        }
                    }
                    else{
                        $tab .= "<pre class='font v11'> $k1 : $v1</pre>";
                    }
                }
            }
            else{
                $tab .= "<li><pre class='font'>$k : $v</pre></li>";
            }
        }
    }
    else{
        $tab .= "<pre>$key : $value</pre>";
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <title>Document</title>
</head>
<header>
   <h3><a id="textTask" href="<?=__FILE__?>">taskManager</a></h3>
</header>
<body id="body">
<ul>
    <?= $tab ?>
</ul>

</body>

</html>
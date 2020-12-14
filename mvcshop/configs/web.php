<?php

return [
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'db' => [
            'host' => 'db',
            'user' => 'artur_base',
            'password' => 'artur_pwd',
            'name' => 'artur_shop',
        ],
        'template' => [
            'viewsDir' => __DIR__ . '/../views',
            'layout' => 'layouts/main',
        ]
    ],
];

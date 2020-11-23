<?php

$configDb = require __DIR__ . '/config.php';

$linkDb = mysqli_connect(
    $configDb['db']['host'],
    $configDb['db']['user'],
    $configDb['db']['password'],
    $configDb['db']['db'],
);

if (!$linkDb) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
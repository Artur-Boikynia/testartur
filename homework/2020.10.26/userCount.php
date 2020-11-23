<?php
session_start();

require_once __DIR__ .'/security.php';
$configDb = require __DIR__ . '/config.php';


$todayDate = date('Y-m-d');

$nameOfUserCount = $_SESSION['user'] ;

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

$sqlCount = <<< SQL
INSERT INTO user_log (`user_name`, `update_at`) values (? , CURRENT_TIMESTAMP)
SQL;          //fixed

$stmtCount = mysqli_prepare($linkDb, $sqlCount);
mysqli_stmt_bind_param($stmtCount, 's',$nameOfUserCount);
mysqli_stmt_execute($stmtCount);

mysqli_stmt_close($stmtCount);

mysqli_close($linkDb);





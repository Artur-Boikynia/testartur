<?php
/*$num = 2;
$configDb = [
    'host' => '172.21.0.1',
    'user' => 'artur_base',
    'password' => 'artur_pwd',
    'db' => 'artur_shop',
];
$linkDb = mysqli_connect(
    $configDb['host'],
    $configDb['user'],
    $configDb['password'],
    $configDb['db'],
);
echo 'gg';*/
/*if (!$linkDb) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo 'gg';
$sqlCount = <<< SQL
INSERT INTO user_log values (? , CURRENT_TIMESTAMP)
SQL;

$stmtCount = mysqli_prepare($linkDb, $sqlCount);
mysqli_stmt_bind_param($stmtCount, 's',$nameOfUserCount);
mysqli_stmt_execute($stmtCount);

mysqli_stmt_close($stmtCount);

mysqli_close($linkDb);
echo 'gg';*/

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
INSERT INTO user_log values (? , CURRENT_TIMESTAMP)
SQL;

$stmtCount = mysqli_prepare($linkDb, $sqlCount);
mysqli_stmt_bind_param($stmtCount, 's',$nameOfUserCount);
mysqli_stmt_execute($stmtCount);

mysqli_stmt_close($stmtCount);

mysqli_close($linkDb);
echo 'sds';
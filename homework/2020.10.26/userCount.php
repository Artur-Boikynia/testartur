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

$sqlCount = "SELECT * FROM user_count WHERE user_login = ?";
$stmtCount = mysqli_prepare($linkDb, $sqlCount);
mysqli_stmt_bind_param($stmtCount, 's',$nameOfUserCount);
mysqli_stmt_execute($stmtCount);
$resultCount = mysqli_stmt_get_result($stmtCount);

$messages = mysqli_fetch_assoc($resultCount);
mysqli_stmt_close($stmtCount);

/*var_dump($messages);
exit;*/

if($messages === null){
    $insertUser = "INSERT INTO user_count values ( ?, ?, ?)";
    $stmtInsert = mysqli_prepare($linkDb, $insertUser);
    mysqli_stmt_bind_param($stmtInsert, 'sis',$nameOfUserCount, $startCount, $todayDate );
    $startCount = 1;
    mysqli_stmt_execute($stmtInsert);
    mysqli_stmt_close($stmtInsert);

}
else{
    if($messages['update_at'] == $todayDate){
        $addCount = $messages['count'] + 1 ;
        $addUser = "UPDATE user_count SET `count` = ? where user_login = ?";
        $stmtAdd = mysqli_prepare($linkDb, $addUser);
        mysqli_stmt_bind_param($stmtAdd, 'is',$addCount ,$nameOfUserCount);
        mysqli_stmt_execute($stmtAdd);
        mysqli_stmt_close($stmtAdd);

    }
    else{
        $removeUser = "DELETE FROM user_count WHERE user_login = ?";
        $stmtRemove = mysqli_prepare($linkDb, $removeUser);
        mysqli_stmt_bind_param($stmtRemove, 's',$nameOfUserCount);
        mysqli_stmt_execute($stmtRemove);
        mysqli_stmt_close($stmtRemove);

        $insertUser = "INSERT INTO user_count values ( ?, ?, ?)";
        $stmtInsert = mysqli_prepare($linkDb, $insertUser);
        mysqli_stmt_bind_param($stmtInsert, 'sis',$nameOfUserCount, $startCount, $todayDate );
        $startCount = 1;
        mysqli_stmt_execute($stmtInsert);
        mysqli_stmt_close($stmtInsert);

    }
}
mysqli_close($linkDb);





<?php
session_start();

require_once __DIR__ .'/security.php';

$todayDate = date('Y-m-d');

$nameOfUserCount = $_SESSION['user'] ;

require_once __DIR__ . '/connect_to_db.php'; // fixed

$sqlCount = <<< SQL
INSERT INTO user_log (`user_name`, `update_at`) values (? , CURRENT_TIMESTAMP)
SQL;          //fixed

/** @var  $linkDb
 * is seted in file "connect_to_db.php"
 */
$stmtCount = mysqli_prepare($linkDb, $sqlCount);
mysqli_stmt_bind_param($stmtCount, 's',$nameOfUserCount);
mysqli_stmt_execute($stmtCount);

mysqli_stmt_close($stmtCount);

mysqli_close($linkDb);





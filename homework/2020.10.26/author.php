<?php
session_start();

$login = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (!$login || !$password) {
    exit('Login and password are required');
}

require_once __DIR__ . '/connect_to_db.php'; // fixed

/**
 * @var $linkDb
 * is seted in file "connect_to_db.php"
 */
$sql = "SELECT * FROM logins WHERE login = ?";
$stmt = mysqli_prepare($linkDb, $sql);  // підготовлює SQL  запрос
mysqli_stmt_bind_param($stmt, 's',$login); // Привязка переменных к параметрам подготавливаемого запроса
mysqli_stmt_execute($stmt); // Выполняет подготовленный запрос
$result = mysqli_stmt_get_result($stmt);  // Получает результат из подготовленного запроса
$user = mysqli_fetch_assoc($result);     // функція яка перетворює нашу строку з бази даеих в масив.

$hash = $user['password'] ?? null;

if( !$hash || !password_verify($password, $hash)){
    exit('Login and password are required');
}

$_SESSION['user'] = $login;
header('Location: index.php');
exit();
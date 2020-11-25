<?php
session_start();
require_once __DIR__ . '/../lib/Connecttodb.php';

$login = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;


if (!$login || !$password) {
    exit('Login and password are required');
}

Connecttodb::SetDb();

$sql = "SELECT * FROM logins WHERE login = ?";
$stmt = mysqli_prepare(Connecttodb::getDb(),$sql);
mysqli_stmt_bind_param($stmt, 's',$login);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

$hash = $user['password'] ?? null;

if( !$hash || !password_verify($password, $hash)){
    exit('Login and password are required');
}

$_SESSION['user'] = $login;
header('Location: index.php');
exit();
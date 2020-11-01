<?php
session_start();

$login = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (!$login || !$password) {
    exit('Login and password are required');
}

$config = require __DIR__ . '/config.php';

$hash = $config['users'][$login] ?? null;

if( !$hash || !password_verify($password, $hash)){
    exit('Login and password are required');
}

$_SESSION['user'] = $login;
header('Location: index.php');
exit();
<?php
session_start();
$logOut = $_POST['logout'] ?? null;

if(!$logOut){
    exit('You are not logged out');
}
require_once __DIR__.'/security.php';

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}


session_destroy();


header('Location: index.php');
exit;
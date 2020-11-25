<?php


class SignOut
{
    private ?string $logOut = null;

    /**
     *
     */
    public function actionSignOut()
    {
        $this->logOut = $_POST['logout'] ?? null;

        if(!$this->logOut){
            exit('You are not logged out');
        }
        $_SESSION = array();
        session_unset();
        session_destroy();
        require_once __DIR__.'/../Login_v3/formauthor.php';
        exit;
    }
}
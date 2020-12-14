<?php


namespace app\components;

use app\components\App;
abstract class SecuredController
{
    /**
     * SecuredController constructor.
     */
    public function __construct()
    {
        if($_SERVER['REQUEST_URI'] !== '/registration/registration' && $_SERVER['REQUEST_URI'] !== '/login/login'){
            if (App::getApp()->getUser()->isGuest()){
                $this->redirect('/login/login');
            }
        }
    }

    /**
     * @param string $address
     * @param int $status
     * @param bool $terminate
     */
    private function redirect(string $address, int $status = 302, bool $terminate = true): void
    {
        header("Location: {$address}", true, $status);
        if ($terminate) {
            exit;
        }
    }

}
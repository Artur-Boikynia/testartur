<?php


namespace app\controllers;

use app\components\App;
use app\components\SecuredController;

class LoginController extends SecuredController
{
    public function actionLogin(){
        App::getApp()->getTemplate()->render('templates/login', 'layouts/login');
    }
}
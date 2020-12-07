<?php


namespace app\controllers;

use app\components\App;
class LoginController
{
    public function actionLogin(){
        App::getTemplate()->render('templates/login', 'layouts/login');
    }
}
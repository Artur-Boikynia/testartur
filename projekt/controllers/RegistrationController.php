<?php


namespace app\controllers;

use app\components\App;
class RegistrationController
{
    public function actionRegistration(){
        App::getTemplate()->render('templates/registration', 'layouts/login');
    }
}
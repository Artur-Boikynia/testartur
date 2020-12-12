<?php


namespace app\controllers;

use app\components\App;
use app\models\RegistrationValidation;

class RegistrationController
{
    public function actionRegistration()
    {
        if(App::getApp()->getRequest()->isPost()){
            $model = new RegistrationValidation();
            $model->doValidation(App::getApp()->getRequest()->getPost());
        }
        App::getApp()->getTemplate()->render('templates/registration', 'layouts/login');
    }

}
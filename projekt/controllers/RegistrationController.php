<?php


namespace app\controllers;

use app\components\App;
use app\components\SecuredController;
use app\models\RegistrationValidation;

class RegistrationController extends SecuredController
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
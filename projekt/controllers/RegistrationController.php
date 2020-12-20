<?php


namespace app\controllers;

use app\components\App;
use app\components\SecuredController;
use app\models\RegistrationValidation;
use app\components\DB;

class RegistrationController extends SecuredController
{
    public function actionRegistration()
    {
        if(App::getApp()->getRequest()->isPost()){
            $post = App::getApp()->getRequest()->getPost();

            $model = new RegistrationValidation();
            $model->doValidation($post);

            App::getApp()->getConnectDB()->inserts($post)->into('uniusers')->exec();

        }
        App::getApp()->getTemplate()->render('templates/registration', 'layouts/login');
    }

}
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
       $qwerty = App::getApp()->getConnectDB()->select('id')->from('uniusers')->where([['id','is not null']])->all();
//        $qwerty = App::getApp()->getConnectDB()->update('uniusers')->set(['name'=>'Ebalomeshatel'])->where([['id', '=', '1']])->exec();
        var_dump($qwerty);
//        $qwerty = App::getApp()->getConnectDB()->delete('uniusers')->exec();
        if(App::getApp()->getRequest()->isPost()){
            $post = App::getApp()->getRequest()->getPost();

            $model = new RegistrationValidation();
            $model->doValidation($post);

            App::getApp()->getConnectDB()->inserts($post)->into('uniusers')->exec();

        }
        App::getApp()->getTemplate()->render('templates/registration', 'layouts/login');
    }

}
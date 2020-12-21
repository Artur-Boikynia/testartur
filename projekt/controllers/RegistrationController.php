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
//       $qwerty = App::getApp()->getConnectDB()->select('id')->from('uniusers')->where([['id','is not null']])->all();
//        $qwerty = App::getApp()->getConnectDB()->update('uniusers')->set(['name'=>'Ebalomeshatel'])->where([['id', '=', '1']])->exec();
//        var_dump($qwerty);
//        $qwerty = App::getApp()->getConnectDB()->delete('uniusers')->exec();

        $qwerty = new RegistrationValidation();
        $qwerty->name = 'Vadym';
        $qwerty->surname = 'Aga';
        $qwerty->email = 'gdfgjkfdjgdf@gmail.com';
        $qwerty->faculty = 'GGWP';
        $qwerty->grupe = 'dp';
        $qwerty->password = 'dpfgdhfgdhfgh';


        $qwerty->create();


        if(App::getApp()->getRequest()->isPost()){
            $post = App::getApp()->getRequest()->getPost();

            $model = new RegistrationValidation();
            $model->doValidation($post);


        }
        App::getApp()->getTemplate()->render('templates/registration', 'layouts/login');
    }

}
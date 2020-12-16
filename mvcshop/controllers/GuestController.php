<?php

namespace app\controllers;

use app\components\AbstractController;
use app\components\App;
use app\models\AccessLog;
use app\models\User;

/**
 * Class GuestController
 * @package app\controllers
 */
class GuestController extends AbstractController
{
    public function actionRegistration(): string
    {
//        $user = User::findOne([['id', '=', 4]]);
//        $user->name = 'New Name';
//        $user->save();
//
//        $user->delete();
//
//        $user2 = new User();
//        $user2->name = 'TEST User 2';
//        $user2->login = '1111';
//        $user2->password = 'p1111p';
//        $user2->save();
//
//        $user2->name = 'Updated';
//        $user2->save();
//
//        $user->delete();

    /*    App::get()
            ->db()
            ->update('users')
            ->set(['name' => mt_rand()])
            ->where([
                ['id', '=', 4]
            ])
            ->execute();*/

       /* App::get()
            ->db()
            ->delete()
            ->from('users')
            ->where([
                ['id', '=', 3]
            ])
            ->execute();*/

        $query = App::get()
            ->db()
            ->select(['id', 'name', 'password'])
            ->from('users')
            ->where([
                ['id', '>', 1]
            ])
            ->limit(4)
            ->offset(1);

        var_dump($query->buildSQL(), $query->all());exit();

        if ($this->request()->isPost()) {
            $model = new User();
            $model->load($this->request()->post());
            $model->createUser();
            exit;
        }
        return $this->render('guest/registration', [], 'layouts/guest');
    }

    public function actionLogin(): string
    {
        return $this->render('guest/login', [], 'layouts/guest');
    }
}

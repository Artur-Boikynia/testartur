<?php


namespace app\controllers;


use app\components\App;
use app\components\SecuredController;

class MainMenuController extends SecuredController
{
    public function actionMenu(){
        App::getApp()->getTemplate()->render('templates/main');
    }
}

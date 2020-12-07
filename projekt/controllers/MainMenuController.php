<?php


namespace app\controllers;


use app\components\App;

class MainMenuController
{
    public function actionMenu(){
        App::getTemplate()->render('templates/main');
    }
}

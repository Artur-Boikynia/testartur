<?php

require_once __DIR__ . '/../models/categories.php';

function actionShowAll()
{
    require_once __DIR__ . '/../views/categories/showall.php';
}

function actionShow()
{
    require_once __DIR__ . '/../views/categories/selectdata.php';
}

function actionCreate()
{
    /*if ($_POST && createCategory($_POST)) {
        header('Location: /homework/2020.11.11/categories/show-all');
        exit;
    }*/
    require_once __DIR__ . '/../views/categories/create.php';
    createCategory($_POST);
}

function actionDelete()
{
    require_once __DIR__ . '/../views/categories/selectfordelete.php';
    $resultOfFunction = selectForDelete($_POST);
    if (empty($resultOfFunction)){
        functionOfDelete($_POST);
    }
    else{
        $textForExit = '';
        $countFor = count($resultOfFunction);
        for ($i = 0; $i < $countFor; $i++){
            $textForExit .= '"' . $resultOfFunction[$i]['title'] . '"'. PHP_EOL;
        }
        exit("You can`t delete this category, because it has such child categories {$textForExit}");
    }
}

function actionUpdate()
{
    require_once __DIR__ . '/../views/categories/update.php';

    updateCategory($_POST);

}

function actionSignOut()
{
    $logOut = $_POST['logout'] ?? null;

    if(!$logOut){
        exit('You are not logged out');
    }
    $_SESSION = array();
    session_unset();
    session_destroy();
    require_once __DIR__.'/../Login_v3/formauthor.php';
    exit;
}
<?php


class Create extends Actionwithcategories
{
    /**
     *
     */
    public function actionCreate():void
    {
        $categoriesArray = $this->getCategories();

        require_once __DIR__ . '/../views/categories/create.php';

        $arrayForCreate = $_POST;

        $this->createCategories($arrayForCreate);
    }
}
<?php


class Show extends Actionwithcategories
{
    /**
     *
     */
    public function actionShow()
    {
        $categories = $this->getCategories();

        require_once __DIR__ . '/../views/categories/selectdata.php';

        $post = $_POST;
        $selectedCategories = $this->getCategoriesOne($post);

        require_once __DIR__ . '/../views/categories/selectdatapart2.php';
    }
}
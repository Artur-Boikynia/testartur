<?php


class ShowAll extends Actionwithcategories
{
    /**
     *
     */
    public function actionShowAll(){
        $categories = $this->getCategories();
        require_once __DIR__ . '/../views/categories/showall.php';
    }
}
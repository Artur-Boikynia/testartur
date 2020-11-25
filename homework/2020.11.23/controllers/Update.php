<?php


class Update extends Actionwithcategories
{
    private array $selected = array();

    /**
     *
     */
    function actionUpdate()
    {
        $categories = $this->getCategories();

        require_once __DIR__ . '/../views/categories/update.php';
        $this->selected = $_POST;
        $this->updateCategory($this->selected);
    }
}
<?php


class Delete extends Actionwithcategories
{
    private array $selected = array();

    /**
     *
     */
    public function actionDelete():void
    {
        $categoriesArray = $this->getCategories();

        require_once __DIR__ . '/../views/categories/selectfordelete.php';
        $this->selected = $_POST;
        $resultOfFunction = $this->selectForDelete($this->selected);
        $this->deletePosition($resultOfFunction);
    }

    /**
     * @param array $arrayOfPosition
     */
    private function deletePosition(array $arrayOfPosition):void{

        if (empty($arrayOfPosition)){
            $this->functionOfDelete($this->selected);
        }
        else{
            $textForExit = '';
            $countFor = count($arrayOfPosition);
            for ($i = 0; $i < $countFor; $i++){
                $textForExit .= '"' . $arrayOfPosition[$i]['title'] . '"'. PHP_EOL;
            }
            exit("You can`t delete this category, because it has such child categories {$textForExit}");
        }
    }
}

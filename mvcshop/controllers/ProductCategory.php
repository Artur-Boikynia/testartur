<?php
namespace app\controllers;


use app\components\Dispatcher;
use app\controllers\Route;
use app\helpers\StringsHelper;


/**
 * Class ProductCategory
 * @package app\controllers
 */
class ProductCategory
{
    /**
     * @var string
     */
    private string $method = '';
    /**
     * @var array
     */
    private array $parameters = array();

    /**
     * ProductCategory constructor.
     */
    public function __construct(){
        $category = Route::getCategory();
        $this->checkCategory($category);
//        echo "Class: \"{$category}\"</br>";
        $this->checkMethod();

    }

    /**
     * @param Dispatcher|null $dispatcher
     * @param int|null $p1
     * @param int|null $p2
     * @return Dispatcher
     */
   /*public function actionEdit( ?Dispatcher &$dispatcher, ?int $p1 = null, ?int $p2 = null):Dispatcher{

       (array)$array = Route::getGetParam();

       if (count($array) > 2) {
           exit('Must be not more than two parameters');
       }
       if (empty($array)) {
           exit('No parameters were passed');
       }

       if (!array_key_exists('p1', $array)) {
           exit('Parameter p1 was not passed ');
       }

       if (!array_key_exists('p2', $array)) {
           exit('Parameter p2 was not passed ');
       }

        if($p1 === null || $p2 === null){
            $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
            $this->showFunction($dispatcher->getParams());
            return $dispatcher;
        }
        else{
            $_GET['p1'] = $p1;
            $_GET['p2'] = $p2;
            $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
            $this->showFunction($dispatcher->getParams());
            return $dispatcher;
        }
    }*/

    /**
     *
     */

    public function actionEdit(?int $p1 = null, ?int $p2 = null)
   {
       (array)$array = Route::getGetParam();

       if (count($array) > 2) {
           exit('Must be not more than two parameters');
       }
       if (empty($array)) {
           exit('No parameters were passed');
       }
       if (!array_key_exists('p1', $array)) {
           exit('Parameter p1 was not passed ');
       }
       if (!array_key_exists('p2', $array)) {
           exit('Parameter p2 was not passed ');
       }

       $actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
       $url_parts = parse_url($actual_link);
       parse_str($url_parts['query'], $params);

       if ((int)$params['p1'] === $p1 && (int)$params['p2'] === $p2) {
            var_dump($params);
           exit();
       }

       $params['p1'] = $p1;
       $params['p2'] = $p2;
       $url_parts['query'] = http_build_query($params);

       if ($p1 === null || $p2 === null) {
           exit('Parameters not entered');
       }
       else {
           $newUrl = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $url_parts['query'];
           header("Location: $newUrl");
           exit;
       }
   }


    /**
     * @param array $array
     */
    private function showFunction(array $array):void{
        $action = Route::getAction();
        foreach ( $array as $key => $value){
            echo "{$action} have GET-parameter \"{$key}\" with value \"{$value}\" </br>";
        }
    }

    /**
     *
     */
    private function checkMethod(){
        $this->method = Route::getAction();
        $bool = method_exists('\app\controllers\ProductCategory', $this->method );
        if($bool === false){
            exit('You selected the wrong action');
        }
    }

    /**
     * @param string $nameOfCategory
     * @param string $separator
     */
    private function checkCategory(string $nameOfCategory, string $separator = '\\'){
        $className = explode($separator, __CLASS__);
        $stringClass = end($className);
        if ($nameOfCategory !== $stringClass){
            exit('You selected the wrong category');
        }
    }
}
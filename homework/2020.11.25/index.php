<?php

declare(strict_types=1);

error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';


$dispatcher = new \app\components\Dispatcher($_SERVER['REQUEST_URI']);



$pre = new app\controllers\Route($dispatcher);


(new \app\controllers\ProductCategory())->actionEdit($dispatcher,897, 1);       // vriant №1

//(new \app\controllers\ProductCategory())->actionEdit(11111,656757);               // variant №2



// URL: local-shop.com:8011/product-category/edit?p1=2&p2=3
// Generate controller class: \app\controllers\ProductCategoryController
// Generate action method: actionEdit
// (new \app\controllers\ProductCategoryController())->actionEdit($p1, $p2);

?>
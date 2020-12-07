<?php


namespace app\components;

use app\components\Dispatcher;
use app\components\Router;
use app\components\Template;
use app\exceptions\FalseVariablesException;

/**
 * Class App
 * @package app\components
 */
class App
{
    /**
     * @var App|null
     */
    private static ?App $app = null;
    /**
     * @var \app\components\Template|null
     */
    private static ?Template $template = null;
    /**
     * @var string
     */
    private string $config = '';

    /**
     * App constructor.
     */
    private function __construct(){
    }

    /**
     * @param array $config
     * @throws FalseVariablesException
     */
    public static function runApp(array $config):void{
        if(self::$app === null){
            self::$app = new self();
            self::$app->goApp($config);
        }
        else{
            throw new FalseVariablesException('Variable "$app" already is instance "App"!');
        }
    }

    /**
     * @param array $config
     * @throws \app\exceptions\NotFoundException
     */
    public function goApp(array $config){
        $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
        self::$template = new Template($config);
        $router = new Router($dispatcher);
    }

    /**
     * @return App|null
     */
    public static function getApp(): ?App
    {
        return self::$app;
    }

    /**
     * @return \app\components\Template|null
     */
    public static function getTemplate(): ?\app\components\Template
    {
        return self::$template;
    }


    /**
     *
     */
    private function __clone(){

    }



}
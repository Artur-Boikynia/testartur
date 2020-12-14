<?php


namespace app\components;

use app\components\Dispatcher;
use app\components\Router;
use app\components\Template;
use app\components\Request;
use app\components\Validation;
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
    private ?Template $template = null;
    /**
     * @var string
     */
    private string $config = '';

    private ?Request $request = null;
    private ?User $user = null;
    private ?Validation $validation = null;

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
        $this->request = new Request();
        $this->user = new User();
        $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
        $this->template = new Template($config);
        $router = new Router($dispatcher);
    }

    public function setValidation( array $data, array $rules):void{
        $this->validation = new Validation($data, $rules);
    }


    /**
     * @return App|null
     */
    public static function getApp(): ?App
    {
        return self::$app;
    }

    /**
     * @return \app\components\Request|null
     */
    public function getRequest(): ?\app\components\Request
    {
        return $this->request;
    }

    /**
     * @return \app\components\Template|null
     */
    public function getTemplate(): ?\app\components\Template
    {
        return $this->template;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }


    /**
     *
     */
    private function __clone(){

    }



}
<?php


namespace app\components;

use app\components\Dispatcher;
use app\components\Router;
use app\components\Template;
use app\components\Request;
use app\components\Validation;
use app\exceptions\DBException;
use app\exceptions\FalseVariablesException;
use app\helper\StringHelper;
use app\components\DB;
use PDO;

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

    private array $config = array();

    private ?Request $request = null;
    private ?User $user = null;
    private ?Validation $validation = null;
    private ?DB $connectDB = null;

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
        $this->config = $config;
        $this->connectDB = $this->initDB();
        $this->request = new Request();
        $this->user = new User();
        $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
        $this->template = new Template($config);
        $router = new Router($dispatcher);
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    private function initDB(): DB{
        $name = StringHelper::tracerArray('db.name');
        $host = StringHelper::tracerArray('db.host');
        $user = StringHelper::tracerArray('db.user');
        $password = StringHelper::tracerArray('db.password');

        if (!$host || !$user || !$password || !$name) {
            throw new DBException('DB config is invalid (host, user, password, name as required)');
        }

        return new DB($name, $host, $user, $password);

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
     * @return \app\components\DB|null
     */
    public function getConnectDB(): ?\app\components\DB
    {
        return $this->connectDB;
    }

    /**
     * @return \app\components\Validation|null
     */
    public function getValidation(): ?\app\components\Validation
    {
        return $this->validation;
    }

    /**
     *
     */
    private function __clone(){

    }



}
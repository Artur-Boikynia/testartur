<?php


namespace app\controllers;


use app\components\Dispatcher;

/**
 * Class Route
 * @package app\controllers
 */
class Route
{
    /**
     * @var string
     */
    private static string $category = 'none';
    /**
     * @var string
     */
    private static string $action = 'none';
    /**
     * @var array
     */
    private static array $getParam = array();

    /**
     * Route constructor.
     * @param Dispatcher $dispatcher
     */
    public function __construct( Dispatcher $dispatcher){
        $this->setCategory($dispatcher);
        $this->isCategory();
        $this->setAction($dispatcher);
        $this->isAction();
        $this->setGetParam($dispatcher);
        $this->setNameForAction();
        self::$category = $this->prepareName(self::$category);

    }

    /**
     * @return string
     */
    public static function getAction(): string
    {
        return self::$action;
    }

    /**
     * @return string
     */
    public static function getCategory(): string
    {
        return self::$category;
    }

    /**
     * @return array
     */
    public static function getGetParam(): array
    {
        return self::$getParam;
    }

    /**
     * @param string $name
     * @return string
     */
    private function prepareName(string $name):string{
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);

        return $name;
    }

    /**
     *
     */
    private function setNameForAction():void{
        $action = self::getAction();
        $camelCase = $this -> prepareName($action);
        self::$action = 'action' . $camelCase;
    }

    /**
     * @param Dispatcher $dispatcher
     */
    private function setAction(Dispatcher $dispatcher): void
    {
        self::$action = $dispatcher->getActionPart();
    }

    /**
     * @param Dispatcher $dispatcher
     */
    private function setCategory(Dispatcher $dispatcher): void
    {
        self::$category = $dispatcher->getControllerPart();
    }

    /**
     * @param Dispatcher $dispatcher
     */
    private function setGetParam(Dispatcher $dispatcher): void
    {
        self::$getParam = $dispatcher->getParams();
    }

    /**
     *
     */
    private function isCategory():void{
        if(self::$category === 'index'){
            exit ('You have not selected a category');
        }
    }

    /**
     *
     */
    private function isAction():void{
        if(self::$action === 'index'){
            exit ('You have not selected a Action');
        }
    }
}
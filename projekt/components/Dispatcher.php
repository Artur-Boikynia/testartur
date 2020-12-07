<?php


namespace app\components;

use app\helper\GetParts;
use app\helper\StringHelper;
use app\exceptions\InvalidException;
/**
 * Class Dispatcher
 * @package app\components
 */
class Dispatcher
{
    /**
     *
     */
    private const CONTROLLER_NAMESPACE = 'app\controllers';
    /**
     *
     */
    private const MAINMENU_CONTROLLER = 'main-menu';
    /**
     *
     */
    private const MAINMENU_ACTION = 'menu';
    /**
     * @var string
     */
    private string $uri = '';
    /**
     * @var string
     */
    private string $controller = '';
    /**
     * @var string
     */
    private string $method = '';
    /**
     * @var array
     */
    private array $params = array();

    /**
     * Dispatcher constructor.
     * @param string $uri
     * @throws InvalidException
     */
    public function __construct(string $uri){
        $this->uri = $uri;
        $this->prepareUriParts($uri);
        $this->prepareParams();
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $uri
     * @throws InvalidException
     */
    private function prepareUriParts(string $uri):void{
        $arrayControllers = GetParts::getController($uri);

        $controller = array_shift($arrayControllers)?: self::MAINMENU_CONTROLLER;
        $controller = StringHelper::camelcase($controller);

        $method = array_shift($arrayControllers)?: self::MAINMENU_ACTION;
        $method = StringHelper::camelcase($method);

        if(!empty($arrayContollers)){
            throw new InvalidException('You entered false URL');
        };

        $this->controller = $this->getPreparedNameForController($controller);
        $this->method = $this->getPreparedNameForMethod($method);
    }

    /**
     * @param string $controller
     * @return string
     */
    private function getPreparedNameForController(string $controller):string{
        return self::CONTROLLER_NAMESPACE . '\\' . $controller . 'Controller';
    }

    /**
     * @param string $method
     * @return string
     */
    private function getPreparedNameForMethod(string $method):string{
        return 'action' . $method;
    }

    /**
     * @return array
     */
    private function prepareParams():array{
        return $this->params = $_GET;
    }


}
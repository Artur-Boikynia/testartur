<?php


namespace app\components;


use app\exceptions\InvalidException;
use app\helper\StringHelper;

/**
 * Class Template
 * @package app\components
 */
class Template
{
    /**
     * @var string
     */
    private string $viewsDir = '';
    /**
     * @var string
     */
    private string $mainLayout = '';
    /**
     * @var string
     */
    private string $content = '';
    /**
     * @var array
     */
    private array $config = array();

    /**
     * Template constructor.
     * @param array $config
     */
    public function __construct(array $config){
        $this->config = $config;
        $this->setDefaultData();
    }

    /**
     * @param string $template
     * @param string|null $layout
     * @throws InvalidException
     * @throws \app\exceptions\NotFoundException
     */
    public function render(string $template, ?string $layout = null){
        $content = $this->includeTemplate($template);
        $this->includeLayout($content, $layout);

    }

    /**
     * @param string $template
     * @return string
     * @throws InvalidException
     */
    private function includeTemplate(string $template):string{
        $includeTemplate = "{$this->viewsDir}/{$template}.php";
        if(!file_exists($includeTemplate)){
            throw new InvalidException("File \"{$includeTemplate}\" is invalid");
        }
        ob_start();
        require $includeTemplate;
        $this->content = ob_get_clean();

        return $this->content;
    }

    /**
     * @param string $content
     * @param string|null $layout
     * @throws InvalidException
     */
    private function includeLayout(string $content, ?string $layout){
        $layout = $layout ?: 'layouts/main';
        $includeLayout = "{$this->viewsDir}/{$layout}.php";
        if (!file_exists($includeLayout)){
            throw new InvalidException("File \"{$includeLayout}\" is invalid");
        }
        require $includeLayout;
    }

    /**
     *
     */
    private function setDefaultData():void{
        $this->viewsDir = $this->getArrayValue('template.viewsDir');
        $this->mainLayout = $this->getArrayValue('template.layout');
    }

    /**
     * @param string $findValue
     * @return string
     * @throws InvalidException
     */
    private function getArrayValue(string $findValue):string{
        return StringHelper::tracerArray($findValue, $this->config);
    }



}
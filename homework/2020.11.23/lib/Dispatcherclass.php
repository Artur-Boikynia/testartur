<?php
/**
 * Class Dispatcherclass
 */
class Dispatcherclass implements \lib\PrepareableInterface
{
    private array $parts = array();
    private array $config = array();
    private string $url = '';
    private string $file = '';


    /**
     * Dispatcherclass constructor.
     * @param string $url
     * @param array $config
     */
    public function __construct(string $url,array $config)
    {   $this->url=$url;
        $this->config=$config;
        $this->dispatch($url, $config);
        $nameOfFunction = $this->prepareFunctions();
        $this->startFunction($nameOfFunction);
    }

    /**
     * @param string $url
     * @param array $config
     */
    private function dispatch(string $url, array $config): void
    {
        $this->parts = $this->prepareParts($url, $config);
        $this->file = $config['baseDir'] . '/controllers/' . array_shift($this->parts) . '.php';
        if (!file_exists($this->file)) {
            exit("Controller doesn't exists");
        }
    }

    /**
     * @param string $url
     * @param array $config
     * @return array
     */
    public function prepareParts(string $url, array $config): array{
        $prefixEnd = strlen($config['webRout']);
        $url = trim(substr($url, $prefixEnd), " \t\n\r\0\x0B/");
        return explode('/', $url);
    }

    /**
     * @return string
     */
    public function prepareFunctions():string{
        $function = array_shift($this->parts);
        $function = str_replace('-', ' ', $function);
        $function = ucwords($function);
        $function = str_replace(' ', '', $function);
        return $function;
    }

    /**
     * @param string $function
     */
    public function startFunction (string $class):void{
        require_once $this->file;
        if (!class_exists($class)) {
            exit("Action doesn't existtt");
        }
        /////////
    }
}
<?php


namespace app\components;

use app\exceptions\InvalidConfigException;
use app\exceptions\NotFoundException;

/**
 * Class App
 * @package app\components
 */
class App
{
    private array $config;

    /**
     * @var Template|null
     */
    private ?Template $template = null;

    /**
     * App constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function run(): void
    {
        try {
            $this
                ->initRouter()
                ->initDb()
                ->initTemplate();


        } catch (InvalidConfigException $exception) {
            echo $exception->getMessage();
        } catch (NotFoundException $exception) {
            echo '404';
        }
    }

    /**
     * @return $this
     * @throws InvalidConfigException
     * @throws NotFoundException
     */
    private function initRouter(): self
    {
        if (!isset($this->config['controllerNamespace'])) {
            throw new InvalidConfigException('Key "controllerNamespace" is required');
        }

        $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
        new Router($dispatcher, $this->config['controllerNamespace']);

        return $this;
    }

    /**
     * @return $this
     * @throws InvalidConfigException
     */
    private function initDb(): self
    {
        $host = $this->getConfigValue('components.db.host');
        $user = $this->getConfigValue('components.db.user');
        $password = $this->getConfigValue('components.db.password');
        $name = $this->getConfigValue('components.db.name');

        var_dump($host);
        var_dump($user);
        var_dump($password);
        var_dump($name);

        return $this;
    }

    private function initTemplate()
    {
        if (!isset($this->config['components']['template']['viewsDir'])) {
            throw new InvalidConfigException('Key "components.template.viewsDir" is required');
        }
        if (!isset($this->config['components']['template']['layout'])) {
            throw new InvalidConfigException('Key "components.template.layout" is required');
        }

        $this->template = new Template(
            $this->config['components']['template']['viewsDir'],
            $this->config['components']['template']['layout']
        );
    }

    /**
     * @param string $address
     * @param string $delimiter
     * @return string
     * @throws InvalidConfigException
     */
    private function getConfigValue(string $address,  string $delimiter = '.'):string
    {
        $partsOfArray = explode($delimiter, $address);
        $nestedQuantity = count($partsOfArray);

        return $this->findValue($partsOfArray, $nestedQuantity);

    }

    /**
     * @param array $partsOfArray
     * @param int $nestedQuantity
     * @return string
     * @throws InvalidConfigException
     */
    private function findValue( array $partsOfArray, int $nestedQuantity):string{

        $nestedArray = $this->config;

        for ($i = 0; $i<$nestedQuantity; $i++){
            if (!array_key_exists($partsOfArray[$i],$nestedArray)){
                throw new InvalidConfigException("Value \"{$partsOfArray[$i]}\"  was not found");
            }

            $nestedArray = array_filter($nestedArray, static function (string $key) use ($partsOfArray, $i):bool{
                if($partsOfArray[$i] === $key){
                    return true;
                }
                else{
                    return false;
                }
            },ARRAY_FILTER_USE_KEY);


            foreach ($nestedArray as $key => $value){
                $nestedArray = $value;
            }
        }

        if (!is_string($nestedArray)){
            $end = end($partsOfArray);
            throw new InvalidConfigException("Value \"{$end}\"  must be type string");
        }
        if (empty($nestedArray)){
            $end = end($partsOfArray);
            throw new InvalidConfigException("Value \"{$end}\" is empty");
        }

        return $nestedArray;
    }



}
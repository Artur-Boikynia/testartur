<?php
namespace app\components\db;

use PDO;
abstract class DbAbstractQuery
{
    private ?PDO $connect = null;

    protected string $table = '';
    protected array $data = array();

    protected array $binds = [];

    public function __construct(PDO $connection){
        $this->connect = $connection;
    }

    public function exec(){
        $stmt = $this->connect->prepare($this->getSQL());
        $stmt->execute($this->binds);

    }

    /**
     * @return string
     */
    abstract protected function getSQL():string;
}
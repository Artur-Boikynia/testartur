<?php


namespace app\components;


use PDO;
use app\components\App;
use app\components\db\Insert;
class DB
{
    private ?PDO $connection = null;

    public function __construct($name, $host, $user, $password){
        $this->connection = new PDO("mysql:host={$host};dbname={$name}", $user, $password);
    }

    public function inserts(array $data):Insert{

        return (new Insert($this->connection))->setDatas($data);
    }

    /**
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        return $this->connection;
    }
}
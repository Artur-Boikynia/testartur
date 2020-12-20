<?php


namespace app\components;


use app\components\db\Delete;
use app\components\db\Select;
use PDO;
use app\components\App;
use app\components\db\Insert;
use app\components\db\Update;
class DB
{
    private ?PDO $connection = null;

    public function __construct($name, $host, $user, $password){
        $this->connection = new PDO("mysql:host={$host};dbname={$name}", $user, $password);
    }

    public function inserts(array $data):Insert{

        return (new Insert($this->connection))->setDatas($data);
    }

    public function select(string ...$data):Select{

        return (new Select($this->connection))->setFieldss($data);
    }

    public function update(string $tableName){

        return (new Update($this->connection))->setTable($tableName);
    }

    public function delete(string $tableName){

        return (new Delete($this->connection))->setTable($tableName);
    }

    /**
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        return $this->connection;
    }
}
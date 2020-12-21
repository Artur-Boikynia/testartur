<?php


namespace app\components\db\where;

use app\components\App;
use PDO;
abstract class ActivRecord
{
    private ?PDO $connection = null;
    private array $fields = [];
    private string $tableName;
    private ?string $primaryKey = null;

    public function __construct()
    {
        $this->connection = App::getApp()->getConnectDB()->getConnection();
        $this->tableName = 'uniusers';
        $this->setUpFields($this->tableName);
        $this->setUpPrimaryKey($this->tableName);
    }


    public function __get(string $name)
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        if (!array_key_exists($name, $this->fields)) {
            return;
        }

        $this->fields[$name] = $value;
    }


    public function __isset($name): bool
    {
        return array_key_exists($name, $this->fields);
    }

    public function create()
    {
        $fields = array_filter($this->fields, static function ($value) {
            return $value !== null;
        });
        var_dump($fields);
        App::getApp()->getConnectDB()->inserts($fields)->into($this->getTableName())->exec();
    }


    private  function setUpFields(string $tableName): void
    {
        $stmt = $this->connection->query("DESCRIBE `{$tableName}`");
        $this->fields = array_fill_keys($stmt->fetchAll(PDO::FETCH_COLUMN), null);
//       var_dump($this->fields);
    }

    private function setUpPrimaryKey(string $tableName): void
    {
        $stmt = $this->connection->query("SHOW KEYS FROM `{$tableName}` WHERE Key_name = 'PRIMARY'");
        $this->primaryKey = $stmt->fetch(PDO::FETCH_ASSOC)['Column_name'] ?? null;
//        var_dump($this->primaryKey);

    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }
}
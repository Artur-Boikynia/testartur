<?php


namespace app\components\db;

use app\components\db\Where;
use PDO;
class Select extends DbAbstractQuery
{
    private array $fields = [];

    public function from(string $table):self{
        $this->table = $table;

        return $this;
    }


    public function setFieldss(array $field):self{
        $this->fields = $field;

        return $this;
    }

    public function all(int $mode = PDO::FETCH_ASSOC): array
    {
        $this->exec();
        if (!$this->stmt === null) {
            return [];
        }
        return $this->stmt->fetchAll($mode);
    }

    protected function getSQL(): string
    {
        $fields = implode(', ', $this->fields);
        $sql = "SELECT {$fields} FROM `{$this->table}`";

        if ($this->where instanceof Where) {
            $where = $this->where->getSql();
            $this->binds = array_merge($this->binds, $this->where->getBinds());
            $sql .= " WHERE {$where}";
        }
        return $sql;
    }

}
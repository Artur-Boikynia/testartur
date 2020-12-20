<?php
namespace app\components\db;

use app\exceptions\DbExcetion;
use app\components\db\SetUpFields;
class Insert extends DbAbstractQuery
{

    public function setDatas(array $data):self{
        $this->data = $data;
        return $this;
    }

    public function into(string $table):self{
        $this->table = $table;
        return $this;
    }

    protected function getSQL(): string
    {
        if (!$this->data || !$this->table) {
            throw new DbExcetion('Data or table was nor founded');
    }

        $this->data = SetUpFields::fieldsFilter($this->table,$this->data);

        $keys = array_keys($this->data);

        $fields = '`' . implode('`, `', $keys) . '`';
        $aliases = ':' . implode(', :', $keys);

        $this->binds = $this->data;
        $sql="INSERT INTO `{$this->table}` ({$fields}) VALUES ({$aliases})";

        return $sql;
    }
}
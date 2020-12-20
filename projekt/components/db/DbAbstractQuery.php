<?php
namespace app\components\db;

use PDO;
use app\components\db\Where;
use PDOStatement;
abstract class DbAbstractQuery
{
    private ?PDO $connect = null;

    protected string $table = '';
    protected array $data = array();
    protected ?Where $where = null;

    protected array $binds = [];
    /**
     * @var PDOStatement|null
     */
    protected ?PDOStatement $stmt = null;

    public function __construct(PDO $connection){
        $this->connect = $connection;
    }

    public function exec(){
        $this->stmt = $this->connect->prepare($this->getSQL());
        $this->stmt->execute($this->binds);
    }

    public function where(array $conditions, $glue = 'AND'):self{
        $this->where = new Where($conditions, $glue);
        return $this;
    }

    /**
     * @return string
     */
    abstract protected function getSQL():string;
}
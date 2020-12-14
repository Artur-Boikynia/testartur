<?php

namespace app\components\db;

use PDO;
use app\exceptions\DBException;
use PDOStatement;

/**
 * Class AbstractQuery
 * @package app\components\db
 */
abstract class AbstractQuery
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var string
     */
    protected string $table = '';

    /**
     * @var array
     */
    protected array $binds = [];

    /**
     * @var PDOStatement|false
     */
    protected $stmt = false;

    /**
     * Insert constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return bool
     * @throws DBException
     */
    public function execute(): bool
    {
        var_dump($this->buildSQL());
        $this->stmt = $this->connection->prepare($this->buildSQL());
        var_dump($this->binds);
        $result = $this->stmt->execute($this->binds);
        var_dump($result);
        if (!$result) {
            $error = json_encode($this->stmt->errorInfo());
            throw new DBException("{$this->stmt->errorCode()}: {$error}");
        }

        return true;
    }

    /**
     * @return string
     */
    abstract protected function buildSQL(): string;
}
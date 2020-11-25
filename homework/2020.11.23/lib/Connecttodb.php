<?php


class Connecttodb
{
    private static ?Connecttodb $status = null;
    private static string $host = 'db';
    private static string $user = 'artur_base';
    private static string $password = 'artur_pwd';
    private static string $nameOfDb = 'artur_shop';
    private static ?mysqli $dbConnection = null;

    public static function SetDb(): self
    {
        if (self::$status === null) {
            self::$dbConnection = mysqli_connect(self::$host, self::$user, self::$password, self::$nameOfDb);
            self::$status = new self();
        }

        return self::$status;
    }

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    protected static function getDb(): mysqli
    {
        if (self::$dbConnection === null) {
            exit('DB connection is lost');
        }

        return self::$dbConnection;
    }
}

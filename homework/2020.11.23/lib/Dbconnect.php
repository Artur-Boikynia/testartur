<?php


class Dbconnect
{
    private static ?Dbconnect $status = null;


    public static function dbConnect(array $config): self
    {
        if (self::$status === null) {
            $connect = mysqli_connect(
                $config['db']['host'],
                $config['db']['user'],
                $config['db']['password'],
                $config['db']['db']
            );
            if (!$connect) {
                echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
                echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
            self::$status = new self();
        }

        return self::$status;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}

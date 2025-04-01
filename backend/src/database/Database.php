<?php

namespace Src\database;

use PDO;

class Database
{
    private $config;

    private $pdo;

    public function __construct()
    {
        $this->config = [
            "host" => $_ENV['DB_HOST'],
            "port" => $_ENV['DB_PORT'],
            "charset" => $_ENV['DB_CHARSET'],
            "user" => $_ENV['DB_USER'],
            "password" => $_ENV['DB_PASSWORD'],
            "dbname" => $_ENV['DB_NAME'],
        ];

        $dsn = "mysql:" . http_build_query($this->config, "", ";");
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // $this->query(file_get_contents("backend/src/database/testData.sql")); //maybe remove later
    }

    public function query($sql, $params = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }
}

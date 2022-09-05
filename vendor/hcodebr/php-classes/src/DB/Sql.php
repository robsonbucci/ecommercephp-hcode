<?php

namespace Hcode\DB;

use PDO;

class Sql
{
    const   HOSTNAME = "192.168.18.17";
    const   USERNAME = "root";
    const   PASSWORD = "root";
    const   DBNAME = "db_ecommerce";

    private $conn;

    //? 1 - $conn = new \PDO("mysql:dbname=db_ecommerce;host=127.0.0.1", "root", "root");
    public function __construct()
    {
        $this->conn = new \PDO(
            "mysql:dbname=" . Sql::DBNAME . ";host=" . Sql::HOSTNAME,
            Sql::USERNAME,
            Sql::PASSWORD
        );
    }

    private function setParams($statment, $parameters = array())
    {
        foreach ($parameters as $key => $value) {
            $this->setParam($statment, $key, $value);
        }
    }

    // ? 3 - $stmt->bindParams();
    private function setParam($statment, $key, $value)
    {
        $statment->bindParam($key, $value);
    }

    // ? 3 - $stmt->bindParams();
    public function rawQuery($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        //? 4 - $stmt->execute();
        $stmt->execute();
        return $stmt;
    }

    //? 2 - $stmt = $conn->prepare("SELECT * FROM tb_persons");
    public function select($rawQuery, $params = array()): array
    {
        $stmt = $this->rawQuery($rawQuery, $params);
        //? 5 - $result = $stmt->fetchAll();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

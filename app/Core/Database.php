<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'budgetx';

    private $dbh;
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        return $this->dbh->query($sql);
    }

    public function prepare($sql)
    {
        return $this->dbh->prepare($sql);
    }

    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    public function commit()
    {
        return $this->dbh->commit();
    }

    public function rollBack()
    {
        return $this->dbh->rollBack();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}

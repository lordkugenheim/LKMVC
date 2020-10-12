<?php

// TODO improve many

class Database
{
    private $dbh;
    private $stmt;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DBNAME, MYSQL_USER, MYSQL_PASS);
    }

    public function __destruct()
    {
        $this->dbh = null;
    }

    public function select($sql, $args = [])
    {
        $result = $this->query($sql, $args);
        return $result ? $result : [];
    }

    public function insert($sql, $args = [])
    {
        return $this->transaction($sql, $args);
    }

    public function update($sql, $args = [])
    {
        // returns rows affected
    }

    private function query($sql, $args = [])
    {
        try {
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute($args);
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e;
            //do something with $e
        }
    }

    private function transaction($sql, $args = [])
    {
        try {
            $this->dbh->beginTransaction();
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute($args);
            $this->dbh->commit();
        } catch (PDOException | Exception $exception) {
            $this->dbh->rollback();
            $this->error = $exception;
        }
        return isset($exception) ? false : true;
    }
}

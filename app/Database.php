<?php

// TODO improve many

class Database
{
    private $dbh;
    private $stmt;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DBNAME, MYSQL_USER, MYSQL_PASS);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            $this->last_insert_id = $this->dbh->lastInsertId();
            $this->dbh->commit();
            $this->last_error = false;
        } catch (PDOException | Exception $exception) {
            $this->dbh->rollback();
            $this->last_error = $exception;
        }
        return $this->last_error ? false : true;
    }
}

<?php

class Database
{
    private $dbh;
    private $stmt;
    private $last_rows_updated;
    private $last_insert_id;
    private $last_error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DBNAME;
        $options = [
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, MYSQL_USER, MYSQL_PASS, $options);
        } catch (Exception $exception) {
            $this->last_error = $exception->getMessage();
        }
    }

    public function select($sql, $args = [])
    {
        $result = $this->query($sql, $args);
        return $result ? $result : [];
    }

    public function insert($sql, $args = [])
    {
        if ($this->transaction($sql, $args)) {
            return $this->last_insert_id;
        } else {
            return false;
        }
    }

    public function update($sql, $args = [])
    {
        if ($this->transaction($sql, $args)) {
            return $this->last_rows_updated;
        } else {
            return false;
        }
    }

    private function query($sql, $args = [])
    {
        try {
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute($args);
            $this->last_error = false;
        } catch (PDOException | Exception $exception) {
            $this->last_error = $exception;
        }
        if (!$this->last_error) {
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    private function transaction($sql, $args = [])
    {
        try {
            $this->dbh->beginTransaction();
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute($args);
            $this->last_insert_id = $this->dbh->lastInsertId();
            $this->last_rows_updated = $this->stmt->rowCount();
            $this->dbh->commit();
            $this->last_error = false;
        } catch (PDOException | Exception $exception) {
            $this->dbh->rollback();
            $this->last_error = $exception;
        }
        return $this->last_error ? false : true;
    }
}

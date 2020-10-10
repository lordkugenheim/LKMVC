<?php

class Database
{
    private $dbh;

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
        // returns id of insert(s)
    }

    public function update($sql, $args = [])
    {
        // returns rows affected
    }

    private function query($sql, $args = [])
    {
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e;
            //do something with $e
        }
    }

    private function transaction($sql, $args = [])
    {
        try {
            $this->dbh->beginTransaction();
            $this->dbh->prepare($sql);
            foreach ($args as $key => $value) {
                $this->dbh->bindParam($key, $value);
            }
            $this->dbh->commit();
        } catch (Exception $e) {
            $this->dbh->rollback();
            // do something with $e
        }
    }
}

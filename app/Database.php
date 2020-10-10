<?php

class Database
{
    private $dbh;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=' . MYSQL_HOST . 'dbname=' . MYSQL_DBNAME, MYSQL_USER, MYSQL_PASS);
    }

    public function __destruct()
    {
        $this->dbh = null;
    }

    public function query($sql, $args = [])
    {
        try {
            $this->dbh->beginTransaction();
            $this->dbh->prepare($sql);
            foreach ($args as $key => $value) {
                $this->dbh->bindParam($key, $value);
            }
            $this->dhb->commit();
        } catch (Exception $e) {
            $this->dbh->rollback();
            // do something with $e
        }
    }
}

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
}
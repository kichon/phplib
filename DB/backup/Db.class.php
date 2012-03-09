<?php

class Db
{
    static private $instance;
    private $dbh;

    private function __construct() {
    }

    static public function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new Db();

        return self::$instance;

    }

    public function connect() {
        $dsn = 'mysql:host=localhost;dbname=twit';
        $username = 'root';
        $password = '';
        $this->dbh = new PDO($dsn, $username, $password);

        return true;
    }

    public function find() {
    }

    public function findAll() {
        $sth = $this->dbh->prepare('select * from users');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query() {
    }
}

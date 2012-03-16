<?php

class MySQL extends DboSource {

    public function connect() {
        $dsn = 'mysql:host=localhost;dbname=test';
        $username = 'root';
        $password = '';
        $this->dbh = new PDO($dsn, $username, $password);

        return true;
    }

    public function read($table) {
        $sth = $this->dbh->prepare('select * from '.$table);
        try {
            $sth->execute();
        } catch(Exception $e) {
            var_dump($e);
        }

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}

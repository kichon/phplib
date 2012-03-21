<?php

class MySQL extends DboSource {

    public function __construct($config = null) {
        parent::__construct($config);
    }

    public function connect() {
        $dsn = 'mysql:host='.$this->config->config['host'].';dbname='.$this->config->config['database'];
        $username = $this->config->config['user'];
        $password = $this->config->config['password'];
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
        //var_dump(get_class($sth));

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}

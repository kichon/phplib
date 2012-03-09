<?php
require_once 'MySQL.class.php';

class Connection {

    static private $instance;

    private function __construct() {
    }

    static public function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new Connection();

        return self::$instance;
    }

    public function connect() {
    }

    public function getDataSource() {
        $_this = Connection::getInstance();

        if (!empty($_this->dataSources['mysql'])) {
            return $_this->dataSources['mysql'];
        }

        $_this->dataSources['mysql'] = new MySQL();

        return $_this->dataSources['mysql'];
    }
}

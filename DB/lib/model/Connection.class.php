<?php

class Connection {

    static private $instance;
    static private $_init;
    static private $config;

    private function __construct() {
        include_once dirname(__FILE__).'/../../config/database.php';
        if (class_exists('DB_CONFIG')) {
            self::$config = new DB_CONFIG();
        }
        self::$_init = true;
    }

    static public function _init() {
    }

    static public function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new Connection();

        return self::$instance;
    }

    public function connect() {
    }

    public function getDataSource() {
        if (empty(self::$_init)) {
            self::_init();
        }

        $_this = Connection::getInstance();

        if (!empty($_this->dataSources[self::$config->config['datasource']])) {
            return $_this->dataSources[self::$config->config['datasource']];
        }

        $_this->dataSources[self::$config->config['datasource']] = new MySQL(self::$config);

        return $_this->dataSources['mysql'];
    }
}

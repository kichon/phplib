<?php

class Model {

    private $instance;
    private $table;

    public function __construct() {
        $this->setDataSource();

        if (is_null($this->table))
            $this->table = strtolower(get_class($this)).'s';
        //$this->instance = Connection::getInstance();
    }

    public function getDataSource() {
        $db = Connection::getDataSource();
    }

    public function setDataSource() {
        $this->getDataSource();
    }

    public function findAll() {
        $db = Connection::getDataSource();
        $result = $db->read($this->table);

        return $result;
    }
}

<?php

class DboSource {

    private $dbh;
    protected $config;

    public function __construct($config = null) {
        $this->config = $config;
        return $this->connect();
    }
}

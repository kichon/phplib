<?php

class DboSource {

    private $dbh;

    public function __construct() {
        return $this->connect();
    }
}

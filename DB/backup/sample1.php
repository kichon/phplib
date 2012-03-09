<?php
require_once 'Db.class.php';

$manager = Db::getInstance();
$manager->connect();

$res = $manager->findAll();

var_dump($res);

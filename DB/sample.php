<?php
require_once dirname(__FILE__).'/model/User.class.php';
require_once dirname(__FILE__).'/model/Tweet.class.php';

$u = new User();

$result1 = $u->findAll();

var_dump($result1);


$t = new Tweet();

$result2 = $t->findAll();

var_dump($result2);

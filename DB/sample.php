<?php
require_once dirname(__FILE__).'/ClassLoader.php';

$loader = new ClassLoader();
$loader->registerDir(dirname(__FILE__).'/lib');
$loader->registerDir(dirname(__FILE__).'/lib/model');
$loader->registerDir(dirname(__FILE__).'/model');
$loader->registerDir(dirname(__FILE__).'/config');

$u = new User();

$result1 = $u->findAll();

var_dump($result1);

$t = new Tweet();

$result2 = $t->findAll();

var_dump($result2);

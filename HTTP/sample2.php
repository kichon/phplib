<?php
require_once 'myHttpRequest.class.php';

$req = new myHttpRequest('graph.facebook.com', 80, '/y.kichon');

$res = $req->doGet();

var_dump($res->getResponseCode());
var_dump($res->getResponseBody());

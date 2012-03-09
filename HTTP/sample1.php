<?php
require_once 'myHttpRequest.class.php';

$req = new myHttpRequest('kichon.net', 80, '/php/action.php');

//$req->doGet();
$res = $req->doPost('name=kichon&age=26');

dv($res->getResponseBody());

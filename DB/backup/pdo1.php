<?php

$user = 'root';
$pass = '';

$dbh = new PDO('mysql:host=localhost;dbname=twit', $user, $pass);

/*
$i = 0;
while (1) {

    if ($i == 3) {
        $dbh = null;
    }
    if ($i == 5) {
        break;
    }
    echo $i, PHP_EOL;
    $i++;
    sleep(2);
}
*/

<?php

function dbacktrace()
{
    dv(debug_backtrace());
}

function dfunction()
{
    $dt = dbacktrace();
    dv($dt['function']);
}

function dv() {
    $a = func_get_args();
    var_dump($a);
}

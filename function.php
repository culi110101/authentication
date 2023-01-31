<?php

function ddd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die;

}

function getSession($key = null)
{
    if ($key && isset($_SESSION["$key"]))
        return $_SESSION["$key"];
    return false;
}
function setSession($key = null, $value = null)
{
    if ($key || $value) {
        $_SESSION["$key"] = $value;
        return true;
    }
    return false;
}

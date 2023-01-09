<?php
session_start();
require_once 'function.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Model.php';
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

$action = isset($_GET["action"]) ? $_GET["action"] : null;



//get pages client want to connect
$page = isset($_GET["page"]) ? $_GET["page"] : 'home';

if (!is_null($action)) {
    $page = 'post'.ucfirst($action);
}

$controller = new Controller();
$controller->$page();
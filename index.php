<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__ . DS);
define('TEMPLATE_EXT', '.tpl');
require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'autoload.php';
require BASE_PATH . 'function.php';

$app            = System\App::instance();
$app->request   = System\Request::instance();
$app->route     = System\Route::instance($app->request);

$route          = $app->route;

require BASE_PATH . 'routes.php';


$route->end();

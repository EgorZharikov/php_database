<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
define('APP_PATH', dirname(__DIR__));
define('APP_CONFIG', require_once APP_PATH . "/config/config.php");
require_once APP_PATH . "/vendor/autoload.php";

use App\Core\Route;

$route = new Route();
$route->start();

?>
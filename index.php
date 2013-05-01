<?php 
require_once 'Core/bootstrap.php';

$router = new Core\Router(ROUTE);
$router->resolve();

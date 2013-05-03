<?php 
namespace Core;
// Ignore notices
error_reporting(E_ALL ^ E_NOTICE);
require_once 'Core/bootstrap.php';

$router = new Router();
$router->add(new Route(ltrim(URI, '/')));
$router->resolve();
$controllerName = $router->getControllerName();
$controller = new $controllerName();
$controller->make();

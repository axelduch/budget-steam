<?php 
namespace Core;
// Ignore notices
error_reporting(E_ALL ^ E_NOTICE);
require_once 'Core/bootstrap.php';

$router = new Router();
// Remove the first slash from URI
$router->add(new Route(ltrim(URI, '/')));
// Resolve the URI to map a controller, an action and params if needed
$router->resolve();
// Since you can not instanciate a new object from a method's return value
$controllerName = $router->getControllerName();
// Instanciate the concerned controller
$controller = new $controllerName;
// Set its action to the one resolved by the router
$controller->setAction($router->getAction());
// Let the controller handle what happens next
$controller->init();

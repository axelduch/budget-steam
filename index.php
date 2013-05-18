<?php 
namespace Core;
// Ignore notices
error_reporting(E_ALL ^ E_NOTICE);
require_once 'Core/bootstrap.php';

Debug::log('Creating router');
$router = new Router();
// Remove the first slash from URI
Debug::log('Adding new route');
$router->add(new Route(ltrim(URI, '/')));
// Resolve the URI to map a controller, an action and params if needed
// if no action was successfully parsed
// redirect to controller's default action page
Debug::log('Resolving...');
$router->resolve();
// Since you can not instanciate a new object from a method's return value
Debug::log('Getting controller name');
$controllerName = $router->getControllerName();
// Instanciate the concerned controller
Debug::log("Instanciating controller \"{$controllerName}\"");
$controller = new $controllerName;
// Set its action to the one resolved by the router
Debug::log(sprintf('Setting controller action to "%s"', $router->getAction()));
$controller->setAction($router->getAction());
// Let the controller handle what happens next
Debug::log('Invoking controller');
$controller->invoke();
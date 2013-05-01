<?php

define('APP_DIR', 'budget-steam');
define('DS', DIRECTORY_SEPARATOR);
define('ROUTE', $_SERVER['REQUEST_URI']);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . APP_DIR);
define('M_DIR', ROOT . DS . 'model');
define('V_DIR', ROOT . DS . 'view');
define('C_DIR', ROOT . DS . 'controller');

function generic_autoloader($class) {
    $filename = ROOT . DS . str_replace("\\", DS, $class) . '.php';
    echo $filename;
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register('generic_autoloader');

var_dump($_SERVER['REQUEST_URI']);
var_dump(
    new Core\AbstractRouter($_SERVER['REQUEST_URI'])
);
<?php

define('APP_DIR', 'budget-steam');
define('DS', DIRECTORY_SEPARATOR);
define('ROUTE', preg_replace('#^/'. APP_DIR . '#', '', $_SERVER['REQUEST_URI']));
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . APP_DIR);
define('M_DIR', ROOT . DS . 'model');
define('V_DIR', ROOT . DS . 'view');
define('C_DIR', ROOT . DS . 'controller');

require('autoload.php');
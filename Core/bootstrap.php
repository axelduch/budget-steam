<?php
namespace Core;

define('APP_DIR', 'budget-steam');
define('DS', DIRECTORY_SEPARATOR);
define('HOST', $_SERVER['HTTP_HOST']);
define('URI', $_SERVER['REQUEST_URI']);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('M_DIR', ROOT . DS . 'model');
define('V_DIR', ROOT . DS . 'view');
define('C_DIR', ROOT . DS . 'controller');
define('TPL_DIR', V_DIR . DS . 'templates');

require('autoload.php');
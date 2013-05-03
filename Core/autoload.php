<?php
namespace Core;

function generic_autoloader($class) {
    $filename = ROOT . DS . $class . '.php'; 
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register('\Core\generic_autoloader');
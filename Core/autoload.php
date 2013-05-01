<?php

function generic_autoloader($class) {
    $filename = ROOT . DS . str_replace("\\", DS, $class) . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register('generic_autoloader');
<?php
namespace Core;
use Core;

class Router extends AbstractRouter{
    function resolve() {
        $parts = explode('/', $this->path);
        return $parts[0];
    }
}
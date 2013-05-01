<?php
namespace Core;

abstract class AbstractRouter {
    /**
     * @var string
     */
    protected $_path;
    
    function __construct($path) {
        $this->_path = $path;
    }
}
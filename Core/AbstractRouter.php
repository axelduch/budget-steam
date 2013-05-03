<?php
namespace Core;

abstract class AbstractRouter {
    /**
     * @var Route[]
     */
    protected $_map = array();
    
    function add(Route $route) {
        $this->_map[] = $route;
    }
	
	function resolve() {
		throw new \Exception("Method Not Implemented", 1);
	}
}
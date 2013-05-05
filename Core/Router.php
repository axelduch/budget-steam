<?php
namespace Core;
use Controller;

class Router extends AbstractRouter {
	/** @var string */
	protected $_controllerName;
	/** @var string */
	protected $_action;
	
	public function resolve() {
		foreach ($this->_map as $route) { 
		 	/* @var $route Route */
			$controllerName = $route->getControllerName();
	 		if(class_exists($controllerName)) {
				$this->_controllerName = $controllerName;
				$this->_action = $route->getAction();
				break;
			}
		}
	}
	
	public function getControllerName() {
		return $this->_controllerName;
	}
	
	public function getAction() {
		return $this->_action;
	}
}
<?php
namespace Core;
use Controller;

class Router extends AbstractRouter {
	/** @var string */
	protected $_controllerName;
	/** @var string */
	protected $_action;
	/** @var string */
	protected $_defaultAction;
	
	public function resolve() {
		foreach ($this->_map as $route) { 
		 	/* @var $route Route */
			$controllerName = $route->getControllerName();
	 		if(class_exists($controllerName)) {
				$this->_controllerName = $controllerName;
				$this->_action = $route->getAction();
				if (empty($this->_action)) {
					$this->redirect($controllerName, $controllerName::getDefaultAction());
				}
				break;
			}
		}
	}
	
	/**
	 * @todo implement url mapping for params 
	 */
	public function redirect ($controllerName, $action, $params = array()) {
		header(sprintf("Location: %s/%s/%s", HOST, $controllerName, $action));
		exit();
	}
	
	public function getControllerName() {
		return $this->_controllerName;
	}
	
	public function getAction() {
		return $this->_action;
	}
	
	public function getDefaultAction() {
		return $this->_defaultAction;
	}
}
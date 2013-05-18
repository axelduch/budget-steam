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
		Debug::log('Entering method ' . __METHOD__);
		foreach ($this->_map as $route) { 
		 	/* @var $route Route */
			$controllerName = $route->getControllerName();
	 		if(class_exists($controllerName)) {
	 			Debug::log("Found class \"{$controllerName}\"");
				$this->_controllerName = $controllerName;
				Debug::log('Action resolved to "' . $route->getAction() . '"');
				$this->_action = $route->getAction();
				if (empty($this->_action)) {
					$this->redirect($controllerName, $controllerName::getDefaultAction());
				}
				break;
			} else {
				Debug::log(sprintf('Could not resolve route for controller "%s"', $controllerName));
			}
		}
	}
	
	/**
	 * @todo implement url mapping for params 
	 */
	public function redirect ($controllerName, $action, $params = array()) {
		$controllerName = Helper::replacePrefix('\Controller\\', '', $controllerName);
		Debug::log("Redirecting to /$controllerName/$action");
		header(sprintf("Location: /%s/%s", $controllerName, $action));
		flush();
		exit;
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
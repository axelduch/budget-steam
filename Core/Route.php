<?php
namespace Core;
/**
 * @class Route
 */
class Route {
	/** @var string */
	protected $_pattern;
	/** @var string */
	protected $_controllerName;
	/** @var array */
	protected $_params;
	
	public function __construct($pattern) {
		$this->_pattern = $pattern;
		// /controller/:action[/:param1, /:param2, ...]
		$parts = explode('/', $pattern);
		list($controllerName, $params) = $parts;
		if (empty($controllerName)) {
			$controllerName = '\Controller\Index';
		} else {
			$controllerName = '\Controller\\' . $controllerName;
		}
		$this->_controllerName = $controllerName;
		$this->_params = $params;
	}
	
	public function getPattern() {
		return $this->_pattern;
	}
	
	public function getControllerName() {
		return $this->_controllerName;
	}
	
	public function getParams() {
		return $this->_params;
	}
}
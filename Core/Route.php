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
	
	protected $_map = array(
		'controllerName',
		'action',
		'params'
	);
	
	public function __construct($pattern) {
		$this->_pattern = $pattern;
		// /controller/:action[/:param1, /:param2, ...]
		$parts = explode('/', $pattern);
		
		// copy map to an array that will be modified
		$map = $this->_map;
		
		$controllerName = '';
		$action = '';
		$params = array();
		
		while (isset($parts[0])
			&& !empty($parts[0])
			&& isset($map[0])) {
			// params is an array so we should not remove it from map
			if ($map[0] === 'params') {
				$params[] = array_shift($parts);
			} else {
				${$map[0]} = array_shift($parts);
				array_shift($map);
			}
		}
		
		if (empty($controllerName)) {
			$controllerName = '\Controller\Index';
		} else {
			$controllerName = '\Controller\\' . $controllerName;
		}
		$this->_controllerName = $controllerName;
		$this->_action = $action;
		$this->_params = $params;
	}
	public function getAction() {
		return $this->_action;
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
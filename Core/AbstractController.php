<?php
namespace Core;
use View, Model;

abstract class AbstractController {
	/** @var AbstractModel */
	protected $_model;
	/** @var AbstractView */
	protected $_view;
	/** @var string */
	protected static $_defaultAction;
	/** @var string */
	protected $_action;
	/** @var array */
	protected $_availableActions = array();
	
	public function __construct() {
		$reflection = new \ReflectionClass($this);
		if (!$reflection->hasMethod($this::$_defaultAction)) {
			try {
				throw new \Exception('No default action define for ' . $reflection->getName() . '. This is mandatory.');
			} catch (\Exception $e) {
				Debug::log($e->getMessage());
				throw $e;
			}
			
		}
		$ViewClassName = Helper::replacePrefix('\Controller', '\View\\', $reflection->getName());
		$ModelClassName = Helper::replacePrefix('\Controller', '\Model\\', $reflection->getName());
		$this->_view = new $ViewClassName();
		$this->_model = new $ModelClassName;
	}
	
	/**
	 * This method implemented to map an action to a method
	 */
	public function init() {
	}
	/**
	 * @return string The default action bound to the controller
	 */
	public static function getDefaultAction() {
		return self::$_defaultAction;
	}
	/**
	 * Tries to set default action
	 * @throws \Exception if provided action is not available
	 */
	public static function setDefaultAction($action) {
		$action = "$action";
		if (in_array($action, $this->_availableActions)) {
			self::$_defaultAction = $action;
		} else {
			throw new \Exception(sprintf('Provided action "%s" not found in available actions array', $action));
		}
	}
	
	public function setAction($action) {
		$this->_action = "$action";
	}
	
	public function onInvalidAction() {
		$this->_view;
	}
}
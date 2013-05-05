<?php
namespace Core;
use View, Model;

abstract class AbstractController {
	/** @var AbstractModel */
	protected $_model;
	/** @var AbstractView */
	protected $_view;
	/** @var string */
	protected $_action;
	/** @var array */
	protected $_availableActions = array();
	
	public function __construct() {
		$reflection = new \ReflectionClass($this);
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
	
	public function setAction($action) {
		$this->_action = (string) $action;
	}
}
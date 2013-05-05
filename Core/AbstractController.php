<?php
namespace Core;
use View;

abstract class AbstractController {
	/** @var AbstractView */
	protected $_view;
	/** @var string */
	protected $_action;
	/** @var array */
	protected $_availableActions = array();
	
	public function __construct() {
		$reflection = new \ReflectionClass($this);
		$ViewClassName = Helper::replacePrefix('\Controller', '\View\\', $reflection->getName());
		$this->_view = new $ViewClassName();
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
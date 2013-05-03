<?php
namespace Core;
use View;

abstract class AbstractController {
	/** @var AbstractView */
	protected $_view;
	
	public function __construct() {
		$reflection = new \ReflectionClass($this);
		$ViewClassName = Helper::replacePrefix('\Controller', '\View\\', $reflection->getName());
		$this->_view = new $ViewClassName();
	}
}
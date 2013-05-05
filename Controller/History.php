<?php
namespace Controller;
use Core\AbstractController as AbstractController;

class History extends AbstractController {
	protected $_availableActions = array(
		'create',
		'read'
	);
	
	public function init() {
		// Map an action to an available action
		// This is actually implemented as a direct call to a method
		if (($index = array_search($this->_action, $this->_availableActions))) {
			$this->{$this->_availableActions[$index]}();
		}
	}
	
	public function create() {
		$this->_view->setVar('action', 'create');
		$this->_view->init();
		$this->_view->render();
	}
	
	public function read() {
		$this->_view->setVar('showForm', TRUE);
		$this->_view->setVar('items', $this->_model->getPurchasedItems());
		$this->_view->init();
		$this->_view->render();
	}
}

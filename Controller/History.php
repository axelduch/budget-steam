<?php
namespace Controller;
use Core\AbstractController as AbstractController,
	\Model\History as Model;

class History extends AbstractController {
	/** @var Model */
	protected $_model;
	protected $_availableActions = array(
		'create',
		'read'
	);
	
	public function init() {
		// Map an action to an available action
		// This is actually implemented as a direct call to a method
		if (!$this->_action) {
			$this->setDefaultAction('read');
		}
		if (($index = array_search($this->_action, $this->_availableActions))) {
			$this->{$this->_availableActions[$index]}();
		} else if ($this->_defaultAction) {
			$this->{$this->_defaultAction}();
		} else {
			unset($this->_view);
			$this->_view = new \Core\InvalidActionView();
			$this->_view->init();
			$this->_view->render();
		}
	}
	/**
	 * POST request to add an entry to purchase history
	 */
	public function create() {
		$this->_view->init();
		//$this->_model->
		$this->_view->render();
	}
	/**
	 * Displays current history items
	 */
	public function read() {
		$this->_view->setVar('showForm', TRUE);
		$this->_view->setVar('items', $this->_model->getPurchasedItems());
		$this->_view->init();
		$this->_view->render();
	}
}

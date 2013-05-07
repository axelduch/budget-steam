<?php
namespace Controller;
use Core\AbstractController as AbstractController,
	Core\Input as Input;

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
		if (($index = array_search($this->_action, $this->_availableActions)) !== -1) {
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
		$creationStatus = NULL;
		$saveStatus = NULL;
		if (Input::hasPost('purchase')
			&& Input::hasPost('game')
			&& Input::hasPost('price')) {
				$creationStatus = $this->_model->addPurchase(Input::post('game'), Input::post('price'));
				//$saveStatus = $this->_model->save();
		}
		
		$this->_view->setVar('showForm', TRUE);
		switch($creationStatus) {
			case \Model\History::E_WRONG_GAME_NAME:
				$this->_view->setVar('game_name_error', TRUE);
				break;
			case \Model\History::E_WRONG_PRICE:
				$this->_view->setVar('price_error', TRUE);
				break;
			case \Model\History::E_DUPLICATE_ENTRY:
				$this->_view->setVar('duplicate_error', TRUE);
				break;
			default:
				// If we go here, then everything went ok
				$this->_view->setVar('showForm', FALSE);
				break;
		}
		$this->_view->init();
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

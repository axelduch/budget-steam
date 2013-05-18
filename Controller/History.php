<?php
namespace Controller;
use Core\AbstractController as AbstractController,
	Core\Input as Input;

class History extends AbstractController {
	/** @var Model */
	protected $_model;
	protected static $_defaultAction = 'read';
	protected $_availableActions = array(
		'create',
		'read'
	);
	
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
				$saveStatus = $this->_model->save();
		}
		$this->_view->setVar('budget', $this->_model->getAvailableBudget());
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
		$this->_view->setVar('budget', $this->_model->getAvailableBudget());
		$this->_view->setVar('items', $this->_model->getPurchasedItems());
		$this->_view->init();
		$this->_view->render();
	}
}
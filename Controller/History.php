<?php
namespace Controller;
use Core\AbstractController as AbstractController,
	Model\BudgetManager as BudgetManager;

class History extends AbstractController {
	public function make() {
		$budgetManager = new BudgetManager();
		$this->_view->setVar('items', $budgetManager->getPurchasedItems());
		$this->_view->init();
		$this->_view->render();
	}
}

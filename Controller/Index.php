<?php
namespace Controller;
use Core\AbstractController as AbstractController;

class Index extends AbstractController {
	protected static $_defaultAction = 'read';
	protected $_availableActions = array('read');
	
	public function read() {
		$this->_view->init();
		$this->_view->render();
	}
}
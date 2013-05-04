<?php
namespace Controller;
use Core\AbstractController as AbstractController;

class Index extends AbstractController {
    public function make() {
		$this->_view->render();
    }
}
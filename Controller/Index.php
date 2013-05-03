<?php
namespace Controller;
use Core\AbstractController as AbstractController,
	Core\Template as Template;

class Index extends AbstractController {
    public function make() {
    	$this->_view->setVar('title', 'MON TITRE LOL');
    	$this->_view->addTemplate(new Template('generic_header'));
		$this->_view->addTemplate(new Template('generic_content'));
		$this->_view->addTemplate(new Template('generic_footer'));
		$this->_view->render();
    }
}
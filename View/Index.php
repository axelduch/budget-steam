<?php
namespace View;
use Core\AbstractView as AbstractView,
	Core\Template as Template;

class Index extends AbstractView {
	public function render() {
		$this->setVar('title', 'Index');
    	$this->addTemplate(new Template('generic_header'));
		$this->addTemplate(new Template('generic_content'));
		$this->addTemplate(new Template('generic_footer'));
		parent::render();
	}
}

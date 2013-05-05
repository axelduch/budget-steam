<?php
namespace View;
use Core\AbstractView as AbstractView,
	Core\Template as Template;

class History extends AbstractView {
	public function init() {
		$this->setTemplateVar('title', 'Historique des achats');
		$this->addTemplate(new Template('generic_header'));
		$this->addTemplate(new Template('purchase_item'));
		$this->addTemplate(new Template('generic_footer'));
	}
	
	public function render() {
		foreach ($this->_templates as $template) {
			/* @var $template Template */
			if ($template->getName() === 'purchase_item') {
				if(isset($this->_data['items'])
					&& !empty($this->_data['items'])) {
					foreach ($this->_data['items'] as $item) {
						echo $template->fetch((array) $item);
					}
				}
			} else {
				echo $template->fetch($this->_templateData);
			}
		}
	}
}

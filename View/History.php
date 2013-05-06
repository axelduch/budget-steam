<?php
namespace View;
use Core\AbstractView as AbstractView,
	Core\Template as Template;

class History extends AbstractView {
	public function init() {
		$this->setTemplateVar('title', 'Historique des achats');
		$this->addTemplate(new Template('history_header'));
		if ($this->_data['showForm'] === TRUE) {
			$this->addTemplate(new Template('purchase_form'));
		}
		// The render method will fetch "n" times the next template
		// depending on what the model gave to the controller
		$this->addTemplate(new Template('purchase_item'));
		$this->addTemplate(new Template('history_footer'));
	}
	
	public function render() {
		// Sequentially loop through each templates
		foreach ($this->_templates as $template) {
			/* @var $template Template */
			if ($template->getName() === 'purchase_item') { // if the template matches with expected name
				// And at lease one item was found
				if(isset($this->_data['items'])
					&& !empty($this->_data['items'])) {
					// Loop as many times as need to fetch each purchased item's template
					foreach ($this->_data['items'] as $item) {
						echo $template->fetch((array) $item);
					}
				}
			} else { // just fetch current template
				echo $template->fetch($this->_templateData);
			}
		}
	}
}

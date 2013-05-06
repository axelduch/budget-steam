<?php
namespace Core;

class InvalidActionView extends AbstractView {
	public function init() {
		$this->addTemplate(new Template('generic_header'));
		$this->addTemplate(new Template('invalid_action_content'));
		$this->addTemplate(new Template('generic_footer'));
		$this->setTemplateVar('title', 'Page non trouvée');
	}
	
	/**
	 * @todo Struct correctly template::fetch params
	 */
	public function render() {
		parent::render();
		if (!empty($this->_templateData)) {
			foreach ($this->_templateData as $key => $value) {
				foreach ($this->_templates as $template) {
					/* @var $template Template */
					$template->fetch(array($key, $value));
				}
					
			}
		}
	}
}

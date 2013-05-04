<?php
namespace Core;

abstract class AbstractView {
	/** @var array */
	protected $_data = array();
	/** @var Template[] */
	protected $_templates = array();
	
	public function render() {
		foreach ($this->_templates as $template) {
			/* @var $template Template */
			echo $template->fetch(
				array_keys($this->_data),
				array_values($this->_data)
			);
		}
	}
	
	protected function addTemplate(\Core\Template $template) {
		$this->_templates[] = $template;
	}
	
	protected function setVar($varName, $val) {
		$this->_data['$' . $varName] = $val;
	}
}
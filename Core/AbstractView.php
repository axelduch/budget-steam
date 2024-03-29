<?php
namespace Core;
use Core\Template as Template;

abstract class AbstractView {
	/** @var array */
	protected $_data = array();
	/** @var TemplateData[] */
	protected $_templateData = array();
	/** @var Template[] */
	protected $_templates = array();
	
	/**
	 * Override this method to add templates and set variables
	 * 
	 */
	public function init() {
	}
	
	/**
	 * Writes to the page the content of the view
	 * 
	 */
	public function render() {
		foreach ($this->_templates as $template) {
			/* @var $template Template */
			echo $template->fetch($this->_templateData);
		}
	}
	
	public function setVar($varName, $val) {
		$this->_data[$varName] = $val;
	}
	
	protected function addTemplate(Template $template) {
		$this->_templates[] = $template;
	}

	/**
	 * 
	 */
	protected function setTemplateVar($varName, $val) {
		$this->_templateData[$varName] = $val;
	}
	
	protected function getTemplateByName($name) {
		foreach ($this->_templates as $template) {
			/* @var $template Template */
			if ($template->getName() === $name) {
				return $template;
			}
		}
		return NULL;
	}
}
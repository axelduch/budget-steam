<?php
namespace Core;

/**
 * A template is a file with tokens to be replaced with data in it
 * Nothing more, if there is control structure in it, then it's a View
 */
class Template {
	protected $_name;
	protected $_fileContents;
	protected $_filename;
	protected $_IOError = FALSE;
	protected $_loaded = FALSE;
	protected $_extension = '.tpl';
	
	public function __construct($name) {
		$this->_filename = TPL_DIR . DS . $name . $this->_extension;
		if (!is_readable($this->_filename)) {
			Debug::log(sprintf('File is not readable: "%s"', $this->_filename));
			$this->_IOError = TRUE;
		}
	}
	
	/**
	 * Returns the content of a template file
	 * @param array|string $varNames
	 * @param array|string $varValues
	 * @return string|NULL if an IOError occurred
	 */
	public function fetch($varNames, $varValues) {
		$return = NULL;
		if (!$this->_IOError) {
			if (!$this->_fileContents) {
				$this->_fileContents = file_get_contents($this->_filename);
			}
			
			$return = str_replace(
				$varNames,
				$varValues,
				$this->_fileContents
			);
		}
		return $return;
	}
}

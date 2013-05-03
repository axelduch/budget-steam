<?php
namespace Core;

class Debug {
	const L_INFO_LABEL = 'INFO';
	const L_ERROR_LABEL = 'ERROR';
	const L_NOTICE_LABEL = 'NOTICE';
	const L_WARNING_LABEL = 'WARNING';
	
	/**
	 * Forbid instanciation
	 */
	private function __construct() {
	}
	
	public static function log($msg, $type = self::L_INFO_LABEL) {
		$date = date('d-m-Y H:i:s');
		file_put_contents(ROOT . DS . 'var/log/debug.log', "[{$date}][{$type}] {$msg}\n", FILE_APPEND);
	}
}

<?php
namespace Core;

class Helper {
	public static function replacePrefix($prefix, $replacement, $subject) {
		return substr_replace($subject, $replacement, 0, strlen($prefix));
	}
}

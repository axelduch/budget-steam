<?php
namespace Core;

class Input {
	/**
	 * @return boolean
	 */
	public static function hasGet($key) {
		return isset($_GET["$key"]);
	}
	/**
	 * @return boolean
	 */
	public static function hasPost($key) {
		return isset($_POST["$key"]);
	}
	/**
	 * @return mixed
	 */
	public static function get($key) {
		return $_GET["$key"];
	}
	/**
	 * @return mixed
	 */
	public static function post($key) {
		return $_POST["$key"];
	}
}
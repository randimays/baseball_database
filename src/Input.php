<?php

class Input {

	public static function has($key) {
		return isset($_REQUEST[$key]);
	}

	public static function get($key, $default = null) {
		return self::has($key) ? $_REQUEST[$key] : $default;
	}

	public static function isPost(){
	 	return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	private function __construct() {}
}
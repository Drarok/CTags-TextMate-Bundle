<?php

abstract class Autoloader
{
	public static function autoload($className)
	{
		$path = __DIR__ . DS . strtolower($className) . '.php';
		
		if (file_exists($path)) {
			require_once $path;
			return class_exists($className, false);
		} else {
			return false;
		}
	}
}
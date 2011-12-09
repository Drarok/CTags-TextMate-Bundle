<?php

define('DS', DIRECTORY_SEPARATOR);
define('BUNDLE_SUPPORT', __DIR__ . DS);

require_once implode(DS, array(
	__DIR__,
	'classes',
	'autoloader.php'
));

spl_autoload_register('Autoloader::autoload');
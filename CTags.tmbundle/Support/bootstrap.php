<?php

define('DS', DIRECTORY_SEPARATOR);
define('BUNDLE_SUPPORT', __DIR__ . DS);

if (! isset($_SERVER['CT_PROJECT_ROOT'])) {
	throw new Exception(
		'You must set the \'CT_PROJECT_ROOT\' '
		. 'environment variable in your Project.');
}

// Shorthand for the project root.
define('CT_PROJECT_ROOT', rtrim($_SERVER['CT_PROJECT_ROOT'], DS) . DS);

require_once implode(DS, array(
	__DIR__,
	'classes',
	'autoloader.php'
));

spl_autoload_register('Autoloader::autoload');
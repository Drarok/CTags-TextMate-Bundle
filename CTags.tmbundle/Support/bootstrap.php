<?php

define('DS', DIRECTORY_SEPARATOR);
define('BUNDLE_SUPPORT', __DIR__ . DS);

if (isset($_SERVER['CT_PROJECT_ROOT'])) {
	define('CT_PROJECT_ROOT', rtrim($_SERVER['CT_PROJECT_ROOT'], DS) . DS);
} else if (isset($_SERVER['TM_PROJECT_DIRECTORY'])) {
	define('CT_PROJECT_ROOT', rtrim($_SERVER['TM_PROJECT_DIRECTORY'], DS) . DS);
} else {
  throw new Exception(
	'You must set the \'CT_PROJECT_ROOT\' '
	. 'environment variable in your Project.');
}

require_once implode(DS, array(
	__DIR__,
	'classes',
	'autoloader.php'
));

spl_autoload_register('Autoloader::autoload');

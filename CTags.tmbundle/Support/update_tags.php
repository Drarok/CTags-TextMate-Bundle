<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

if (! isset($_SERVER['CT_PROJECT_ROOT'])) {
	throw new Exception(
		'You must set the \'CT_PROJECT_ROOT\' '
		. 'environment variable in your Project.');
}

// Shorthand for the project root.
define('CT_PROJECT_ROOT', rtrim($_SERVER['CT_PROJECT_ROOT'], DS) . DS);

$cmd = implode(' ', array(
	escapeshellcmd(BUNDLE_SUPPORT . 'bin' . DS . 'ctags'),
	'-f',
	escapeshellarg(CT_PROJECT_ROOT . 'tmtags'),
	'--fields=Kn',
	'--excmd=pattern',
	'-R',
	'--regex-PHP=\'/abstract class ([^ ]*)/\\1/c/\'',
	'--regex-PHP=\'/interface ([^ ]*)/\\1/c/\'',
	'--regex-PHP=\'/(public |static |abstract |protected |private )+function ([^ (]*)/\\2/f/\'',
	escapeshellarg(CT_PROJECT_ROOT),
));

var_dump($cmd);

$output = array();
$exitCode = null;
exec($cmd, $output, $exitCode);
$output = implode(PHP_EOL, $output);
<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

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

$output = array();
$exitCode = null;
exec($cmd, $output, $exitCode);
$output = implode(PHP_EOL, $output);

if ($exitCode !== 0) {
	throw new Exception('Failed to execute ctags: ' . $output);
}

echo 'Project tags updated.';
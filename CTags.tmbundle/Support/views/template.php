<?php

$styleSheet = BUNDLE_SUPPORT . 'css' . DS . 'style_screen.css';

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo isset($title) ? $title : 'CTags'; ?></title>
	<link rel="stylesheet" type="text/css" href="file://<?php echo $styleSheet; ?>" />
</head>
<body>
<?php

echo isset($content)
	? $content
	: null;

if (isset($scripts)) {
	array_unshift($scripts, 'jquery');
	$scriptSkel = '<script type="text/javascript" src="file://%s"></script>';
	foreach ($scripts as $script) {
		$script = BUNDLE_SUPPORT . 'js' . DS . $script . '.js';
		echo sprintf($scriptSkel, $script), PHP_EOL;
	}
}

?>
</body>
</html>

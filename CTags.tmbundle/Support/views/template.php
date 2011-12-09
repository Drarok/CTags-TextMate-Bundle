<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo isset($title) ? $title : 'CTags'; ?></title>
</head>
<body>
<?php

echo isset($content)
	? $content
	: null;

?>
</body>
</html>

<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// TODO: Find some tags.
$foundTags = array(
	(object) array(
		'name' => 'Show Line 6',
		'file' => __FILE__,
		'line' => 6,
	),
	(object) array(
		'name' => 'Just Open File',
		'file' => __FILE__,
	),
);

// Instantiate the template first.
$template = View::factory('template');
$template->addScript('find_tag');

// Loop over each found tag, rendering to HTML.
$content = array();
$tagView = View::factory('tag');
foreach ($foundTags as $foundTag) {
	$tagView->tag = $foundTag;
	$content[] = $tagView->render(false);
}

// Assign the HTML into the template.
$template->content = implode(PHP_EOL, $content);

// Render.
$template->render();
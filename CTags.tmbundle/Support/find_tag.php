<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// TODO: Find some tags.
$foundTags = array();

// Instantiate the template first.
$template = View::factory('template');

// Loop over each found tag, rendering to HTML.
$content = array();
$tagView = View::factory('tag');
foreach ($foundTags as $foundTag) {
	$tagView->tag = $foundTag;
	$content[] = $tagView->render(false);
}

// Assign the HTML into the template.
$template->content = implode('<br />'.PHP_EOL, $content);

// Render.
$template->render();
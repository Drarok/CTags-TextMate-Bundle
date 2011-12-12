<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

if (! isset($_SERVER['TM_CURRENT_WORD'])) {
	throw new Exception('Failed to find TM_CURRENT_WORD variable.');
}

// TODO: Find some tags.
$parser = new CTagParser(CT_PROJECT_ROOT . 'tmtags');
$foundTags = $parser->findTag($_SERVER['TM_CURRENT_WORD']);
var_dump($foundTags);
die();

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
<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

if (! isset($_SERVER['TM_CURRENT_WORD'])) {
	throw new Exception('Failed to find TM_CURRENT_WORD variable.');
}

// Instantiate the template first.
$template = View::factory('template');

// Find some tags.
$parser = new CTagParser(CT_PROJECT_ROOT . 'tmtags');
$tags = $parser->findTag($_SERVER['TM_CURRENT_WORD']);

// Instantiate a new view for the tags.
$tagsView = View::factory('tags');
$tagsView->tags = $tags;

if ($tags) {
	// Make sure the javascript it loaded when we have tags.
	$template->addScript('find_tag');
}

// Pass the tags view to the template.
$template->content = $tagsView;

// Render.
$template->render();
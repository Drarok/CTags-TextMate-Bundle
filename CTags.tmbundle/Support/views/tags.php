<?php

if (is_array($tags) && count($tags)) {
	$tagView = View::factory('tag');

	foreach ($tags as $tag) {
		$tagView->tag = $tag;
		$tagView->render();
	}
} else {
?>
	<div class="error">There are no tags to display.</div>
<?php
}

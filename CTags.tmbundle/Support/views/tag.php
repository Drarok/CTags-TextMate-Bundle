	<?php echo HTML::tag('div', array(
		'class'=> 'tag',
		'file' => $tag->file,
		'line' => isset($tag->line) ? $tag->line : null,
		'title' => $tag->file,
	)); ?>
		<span class="name"><?php echo $tag->name; ?></span>
	</div>
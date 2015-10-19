	<?php echo HTML::tag('div', array(
		'class'=> 'tag',
		'file' => $tag->file,
		'line' => isset($tag->line) ? $tag->line : null,
		'title' => $tag->file,
	)); ?>
		<span class="file"><?php echo $tag->file; ?></span>
		<br />
		<span class="name"><?php echo $tag->name; ?></span>
<?php if (isset($tag->line)) { ?>
		<br />
		<span class="line">Line: <?php echo $tag->line; ?></span>
<?php } ?>
	</div>
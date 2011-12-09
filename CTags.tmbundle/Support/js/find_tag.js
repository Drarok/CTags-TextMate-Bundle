$(function() {
	$('.tag').css('cursor', 'pointer')
		.click(function() {
			var rel = $(this).attr('rel');
			window.location = 'txmt://open/?url=' + rel;
		});
});
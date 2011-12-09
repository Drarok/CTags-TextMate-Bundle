$(function() {
	$('.tag').css('cursor', 'pointer')
		.click(function() {
			var file = $(this).attr('file');
			var line = $(this).attr('line');
			
			var url = 'txmt://open/?url=file://' + encodeURI(file);
			
			if (line) {
				url += '&line=' + line;
			}
			
			window.location.href = url;
		});
});
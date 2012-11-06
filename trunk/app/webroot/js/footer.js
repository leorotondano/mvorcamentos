$(document).ready(function() {	
	bodyHeight = $('body').height();
	footerHeight = $('.footer').height();
	browserHeight = window.innerHeight;
	if((bodyHeight + footerHeight) < browserHeight)
	{
		$('.footer').css('position', 'fixed');
		$('.footer').css('bottom', '0');
		$('.footer').css('left', '0');
	}
	else
	{
		$('.footer').css('position', 'relative');
		$('.site_body').css('margin-bottom', '10px')
	}
	$('.footer').show();
});

document.createElement( "picture" );

$(document).ready(function(){
			var mn = $(".navbar");
		    var mns = "navbar-scrolled";
		    var hdr = mn.offset().top;
			
		$(window).scroll(function() {
		  if( $(this).scrollTop() > 100 ) {
		    mn.addClass(mns);
		  } else {
		    mn.removeClass(mns);
		  }
		});
});


jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.back-to-top');

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
}); 
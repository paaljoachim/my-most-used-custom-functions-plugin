// Back to top button

jQuery(document).ready(function($){
    var offset = 100; // How many pixels are scrolled down the page before the button appears.
    var speed = 250; // How fast the page goes to the top. The higher the number the slower the movement.

    var duration = 500; // Speed of the fade animation.
	   $(window).scroll(function(){
            if ($(this).scrollTop() < offset) {
			     $('.back-to-top-button') .fadeOut(duration);
            } else {
			     $('.back-to-top-button') .fadeIn(duration);
            }
        });
	$('.back-to-top-button').on('click', function(){
		$('html, body').animate({scrollTop:0}, speed);
		return false;
		});
});

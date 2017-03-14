$(document).ready(function(){
    // smoothscroll
    $('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 450, 'swing', function () {
	        window.location.hash = target;
	    });
	});
});
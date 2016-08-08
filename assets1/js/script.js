$(document).ready(function () {
	$(window).scroll(function() {
		if ($(this).scrollTop() > 1){  
		    $('nav').addClass("sticky");
		} else {
		    $('nav').removeClass("sticky");
		}
	});

	$('.mostwatch-slider').bxSlider({
	  maxSlides: 3,
	  moveSlides: 1,
	  speed: 1000,
	  // slideWidth: 380,
	  hideControlOnEnd: true,
	  slideMargin: 15,
	  autoReload: true,
	  breaks: [{screen:0, slides:1, pager:false},{screen:460, slides:2},{screen:768, slides:3}]
	});
	
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 200) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});
	});


});


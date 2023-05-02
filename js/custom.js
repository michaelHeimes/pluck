jQuery(document).ready(function(){

jQuery('.solution_slider').slick({
  dots: false,
  arrows:true,
  autoplay: false,
  infinite: false,
  slidesToShow: 1,
  slidesToScroll: 1,
});


jQuery('#header-part .menu_trigger').click(function(e) {
    e.preventDefault();
	jQuery('#header-part .menu_bar').addClass('active');
});
jQuery('#header-part .menu_bar .close').click(function(e) {
    e.preventDefault();
	jQuery('#header-part .menu_bar').removeClass('active');
});



if (jQuery('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = jQuery(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                jQuery('#back-to-top').addClass('show');
            } else {
                jQuery('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    jQuery(window).on('scroll', function () {
        backToTop();
    });
    jQuery('#back-to-top').on('click', function (e) {
        e.preventDefault();
        jQuery('html,body').animate({
            scrollTop: 0
        }, 500);
    });
}



//if(jQuery(window).width() > 767){
	jQuery(window).bind('scroll load', function() {
	var navHeight = jQuery("#header-part").height();
	(jQuery(window).scrollTop() > navHeight) ? jQuery('#header-part').addClass('show') : jQuery('#header-part').removeClass('show');
	});
//}









});

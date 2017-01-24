(function(jQuery){
	"use strict";




jQuery(".gallery-row").removeAttr("style");


jQuery('.menu-item a, a.woocommerce-main-image, a.zoom').addClass('no-animation');
jQuery('.menu-item a, a.zoom').addClass('no-animation');


  /* ==================================================
	Scroll Progress
================================================== */

jQuery(document).ready(function() {
  jQuery(window).on('load scroll resize', function() {

    var docHeight = jQuery(document).height();
    var windowPos = jQuery(window).scrollTop();
    var windowHeight = jQuery(window).height();
    var windowWidth = jQuery(window).width();
    var completion = windowPos / (docHeight - windowHeight);

    if (docHeight <= windowHeight) {
      jQuery('#progress').width(windowWidth);
    } else {
      jQuery('#progress').width(completion * windowWidth);
    }

  });
});


  /* ==================================================
	Mini Menu
================================================== */


        jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 400) {
                jQuery('#mini-header').fadeIn(500);
            } else {
                jQuery('#mini-header').fadeOut(500);
            }
        });





/* ==================================================
	3 Post Slide Center
================================================== */
	// Slick carousel options
	function run__big_slider() {
		// Setup each carousel
		jQuery(".big-post-slider").each( function() {
			var $carousel = jQuery(this);
			$carousel.on('init', function(slick) {
				$carousel.css("display","block");
			}).slick( {
				dots: false,
				infinite: true,
				autoplay: false,
				speed: 600,
				slidesToShow: 3,
				centerMode: true,
				variableWidth: true,
			});
			$carousel.slick('setPosition');

			// Fade in each gallery like a boss
			jQuery(".slick").each( function() {
				jQuery(this).fadeTo( 200, 1 );
			});
			// Add next/prev navigation to the carousel
			jQuery('.slick-slider').on('click', '.slick-slide', function (e) {
				e.stopPropagation();
				var index = jQuery(this).data("slick-index");
				if (jQuery('.slick-slider').slick('slickCurrentSlide') !== index) {
					jQuery('.slick-slider').slick('slickGoTo', index);
				}
			});
            // Add classes to allow next/prev cursor styling
			$carousel.mousemove( function(e){
				var mouseXPosition = e.pageX - this.offsetLeft;
				if (mouseXPosition < jQuery( window ).width() / 2 ) {
					$carousel.removeClass( "right-arrow" );
					$carousel.addClass( "left-arrow" );
				} else {
					$carousel.removeClass( "left-arrow" );
					$carousel.addClass( "right-arrow" );
				}
			});
		});
	}


/* ==================================================
	1 Post Slide 
================================================== */


function run__one_slide() {

	jQuery('.one-post-slider').each( function() {
			var $one_carousel = jQuery(this);
			$one_carousel.on('init', function(slick) {
				$one_carousel.css("display","block");
			}).slick({
				dots: false,
				infinite: true,
				autoplay: false,
				speed: 600,
				slidesToShow: 1,
				slidesToScroll: 1
				});
			$one_carousel.slick('setPosition');
	});
}


/* ==================================================
	 4 Post Slide
================================================== */


function run__small_slide() {

	jQuery('.small-post-slider').each( function() {
			var $small_carousel = jQuery(this);
			$small_carousel.on('init', function(slick) {
				$small_carousel.css("display","block");
			}).slick({
				slidesToShow: 4,
				slidesToScroll: 4,
				dots: false,
				infinite: true,
				autoplay: false,
				speed: 900,
				responsive: [{
					breakpoint: 1024,
					settings: {
						speed: 900,
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: false
					}
					},{
					breakpoint: 770,
					settings: {
						speed: 900,
						slidesToShow: 2,
						slidesToScroll: 2
						}
					},{
					breakpoint: 480,
					settings: {
						speed: 900,
						slidesToShow: 1,
						slidesToScroll: 1
						}
					}
			]});
			$small_carousel.slick('setPosition');
	});
}





/* ==================================================
	Gallery Posts
================================================== */


function ig_posts_slider() {

	jQuery(".ig_posts_slider").css("display","block");
	jQuery('.ig_posts_slider').each( function() {
		var $small_carousel = jQuery(this);
		$small_carousel.on('init', function(slick) {
			jQuery(".ig_posts_slider").css("display","block");
		}).slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true,
			dots: false,
			infinite: true,
			autoplay: false,
			speed: 300,
		});
	});
}









	// Run Slick carousel
	jQuery(window).load( function() {
		run__one_slide();
		run__big_slider();
		run__small_slide();
		ig_posts_slider();
	});

	jQuery(document.body).on( "post-load", function () {
	    setTimeout( function() {
		    run__one_slide();
	        run__big_slider();
	        run__small_slide();
	        ig_posts_slider();

	    }, 500 );
	});


/* ==================================================
	Animation Menu
================================================== */


	jQuery('.click_menu, .menu-button').on('click', function(){
		jQuery('.click_menu').toggleClass('is-clicked');
			jQuery('.menu-button').toggleClass('fixed_button_rsp');

		if( jQuery('.container_menu').hasClass('is-visible') ) {
			jQuery('.container_menu').removeClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				jQuery('body').removeClass('overflow-open');
				jQuery('html').addClass('overflow-open');
			});
		} else {
			jQuery('.container_menu').addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				jQuery('html').addClass('overflow-open');
				jQuery('body').addClass('overflow-open');


			});
		}
	});


	jQuery('.menu-button').on('click', function() {
	  jQuery('.ig-icon-menu').toggleClass("fa-bars fa-times");
	});



/* ==================================================
	Animation Search
================================================== */
	jQuery('.click_search').on('click', function(){
		jQuery('.click_search').toggleClass('is-clicked');



		if( jQuery('.container_search').hasClass('is-visible') ) {
			jQuery('.container_search').removeClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				jQuery('body').removeClass('overflow-open');
				jQuery('html').addClass('overflow-open');
			});
		} else {
			jQuery('.container_search').addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				jQuery('html').addClass('overflow-open');
				jQuery('body').addClass('overflow-open');
			});
		}
	});

	jQuery('.search-button').on('click', function() {
	  jQuery('.ig-icon-search').toggleClass("fa-search fa-times");
	});





  /* ==================================================
	Head Reduction
================================================== */

   jQuery(function(){
    jQuery('#mini-header').data('size','big');
});

jQuery(window).scroll(function(){
    var $nav = jQuery('#mini-header');
    if (jQuery('body').scrollTop() > 400) {
        if ($nav.data('size') == 'big') {
            $nav.data('size','small').stop().animate({
                top:'0px'
            }, 600);
        }
    } else {
        if ($nav.data('size') == 'small') {
            $nav.data('size','big').stop().animate({
                top:'-100px'
            }, 600);
        }
    }
});






/* ==================================================
	No Animation Tiled galllery
================================================== */


 jQuery( ".tiled-gallery-item a" ).addClass( "no-animation" );


/* ==================================================
	Menu Mobile
================================================== */


      jQuery('.nav-mobile').navgoco({
              caretHtml: '<i class="some-random-icon-class"></i>',
              accordion: true,
              openClass: 'open',
              save: true,
              cookie: {
                  name: 'navgoco',
                  expires: false,
                  path: '/'
              },
              slide: {
                  duration: 400,
                  easing: 'swing'
              }
          });




/* ==================================================
   Blog masonry
================================================== */

jQuery(window).load(function(){

var $boxes = jQuery('.isotopeItem_masonry');
var $container_masonry = jQuery('.isotopeWrapper');
var $resize = jQuery('.isotopeWrapper');

$boxes.css('opacity', '1');


  var $container_masonry = jQuery('.masonryContainer');
    $boxes.fadeIn();
    $container_masonry.isotope({
        itemSelector: '.isotopeItem_masonry'
                })


  });




/* ==================================================
   Instagram masonry
================================================== */



 jQuery(window).on('resize', function(){
      var win = jQuery(this);
      if (win.width() < 500) {

 jQuery( ".instagram-pics li" ).addClass( "isotopeItem_masonry" );
    jQuery( "#instagram-footer ul" ).addClass( "isotopeWrapper masonryContainer" );


      }
    else
    {
    jQuery( ".instagram-pics li" ).removeClass( "isotopeItem_masonry" );
    jQuery( "#instagram-footer ul" ).removeClass( "isotopeWrapper masonryContainer" );


    }

});




/* ==================================================
   WOW Animation
================================================== */


 var wow = new WOW(
    {
      boxClass:     'wow',      // default
      animateClass: 'animated', // default
      offset:       0,          // default
      mobile:       false,       // default
      live:         true        // default
    }
  )
  wow.init();




/* ==================================================
	Scroll To Top
================================================== */


jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});












/* ==================================================
   FitVids
================================================== */

    jQuery("#vid-container").fitVids();




/* ==================================================
   end
================================================== */
})(jQuery);
<!---- New section start---->

<!--<div>
<div class="container" style="padding-top: 10px;padding-bottom: 20px;">

     <div class="col-sm-12">
<div class="sriv_tit">
        	<h1> Why Use Chandler Sports </h1>
        </div>

     <p class="set-all-footer-top">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
     </div>
</div>
</div>-->
<!---- End section start---->

<div class="footer_up_line">
<!--	<div class="container">
		<div class="col-sm-12">
			<h2>More reasons to shop at Chandler Sports</h2>
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="icon-wrapper">
			  <i class="fa fa-4x fa-thumbs-up"></i>
			</div>
			<h3>Hire before you buy</h3>

			<p>on most fitness equipment</p>
			<?php echo do_shortcode('[custom-facebook-feed id=chandlersports num=5]');?>
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="icon-wrapper">
			  <i class="fa fa-4x fa-sitemap"></i>
			</div>
			<h3>1000's of products</h3>
			<p>with more added every week</p>
			<h4>Google plus feed</h4>
			<?php echo do_shortcode('[gpf_google_plus id=104263035271660173542 height=350px type=page]');?>
		</div>

		<div class="col-md-4 col-sm-12">
			<a href="<?= get_permalink(1645) ?>">
				<div class="icon-wrapper">
				  <i class="fa fa-4x fa-percent"></i>
				</div>
				<h3>Super saver</h3>
				<p>Discover our free super saver areas</p>
			</a>

			<h4>Tumbler feed</h4>
			<div style="max-height: 250px; min-height: 250px !important;overflow: scroll;">
			<?php echo do_shortcode('[powr-tumblr-feed id=2d3dbd99_1487232959]');?>
		</div>
			
		</div>
	</div>-->
	<div class="container">
		<div class="col-sm-12">
			<h2>More reasons to shop at Chandler Sports</h2>
		</div>
		<div class="col-md-3 col-sm-12">
			<h4>Facebook</h4>
			<?php echo do_shortcode('[custom-facebook-feed id=chandlersports num=5]');?>
		</div>
		<div class="col-md-3 col-sm-12">
			<h4>Google plus</h4>
			<?php echo do_shortcode('[gpf_google_plus id=104263035271660173542 height=390px type=page]');?>
		</div>

		<div class="col-md-3 col-sm-12">
			<h4>Tumbler </h4>
			<div style="max-height: 400px; min-height: 400px !important;overflow: scroll;margin-top:20px;">
			<?php //echo do_shortcode('[powr-tumblr-feed id=2d3dbd99_1487232959]');
				echo do_shortcode('[powr-tumblr-feed id=a3e78207_1487246928]');
			?>
		</div>
		</div>
		<div class="col-md-3 col-sm-12">
			<h4>Instagram </h4>
			<?php echo do_shortcode('[instagram-feed num=9 cols=3]');?>
		</div>	
		</div>
	</div>

</div>



<footer>

	<div class="container">

    	<div class="main_footer cf">

        	<div class="col-sm-3">

            	<?php dynamic_sidebar("footer-widget-area");?>

            </div>

            <div class="col-sm-2">

            	<?php dynamic_sidebar("footer-widget-area-2");?>

            </div>

            <div class="col-sm-2">

            	<?php dynamic_sidebar("footer-widget-area-3");?>

            </div>

						<div class="col-sm-2">

            	<?php dynamic_sidebar("footer-widget-area-4");?>

            </div>

            <div class="col-sm-3">

            	<?php dynamic_sidebar("footer-widget-area-5");?>

            </div>

        </div>



        <div class="footer_bot cf">

        	<div class="row">

        	<div class="col-sm-6">

            	<div class="left_fot"><p>&copy; Copyright 2016 <a href="<?php echo home_url( '/' ); ?>">Chandler Sports</a> . All rights reserved </p></div>

            </div>

            <div class="col-sm-6">

            	<div class="rig_pam">
            	
            	<div class="pull-right">
                	<img src="<?php bloginfo('template_directory'); ?>/images/pmant_icon.png" alt="" />
                </div>	
                <div class="pull-right">
            	<img style="width: 38px; padding-right: 3px;" src="<?php bloginfo('template_directory'); ?>/images/zero.png" alt="" />
            	</div>
                </div>

            </div>

            </div>

        </div>



    </div>

</footer>





<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="<?php bloginfo('template_directory'); ?>/js/index.js"></script>

<!--<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>-->



<script src="<?php bloginfo('template_directory'); ?>/js/jquery.bootstrap-responsive-tabs.min.js"></script>


<script>

$('.responsive-tabs').responsiveTabs({

  accordionOn: ['xs', 'sm']

});

</script>



<script src="<?php bloginfo('template_directory'); ?>/js/owl.carousel.js"></script>







<script>

    $(document).ready(function() {

      $("#owl-demo").owlCarousel({



      navigation : true,

      slideSpeed : 300,

      paginationSpeed : 400,

      singleItem : true,

	  autoPlay: 3000, //Set AutoPlay to 3 seconds
	  transitionStyle : 'fade'


      // "singleItem:true" is a shortcut for:

      // items : 1,

      // itemsDesktop : false,

      // itemsDesktopSmall : false,

      // itemsTablet: false,

      // itemsMobile : false



      });

    });

    </script>





   		<script>

		$(document).ready(function() {



		  var owl = $("#owl-demo-1");



		  owl.owlCarousel({





			itemsCustom : [

			  [0, 1],

			  [450, 2],

			  [600, 3],

			  [700, 3],

			  [1000, 4],

			  [1200, 4],

			  [1400, 4],

			  [1600, 4]

			],

			navigation : true,

			autoPlay: 3000, //Set AutoPlay to 3 seconds



		  });



		});

		</script>





        <script>

		$(document).ready(function() {



		  var owl = $("#owl-demo-2");



		  owl.owlCarousel({





			itemsCustom : [

			  [0, 1],

			  [450, 2],

			  [600, 3],

			  [700, 3],

			  [1000, 4],

			  [1200, 4],

			  [1400, 4],

			  [1600, 4]

			],

			navigation : true,

			autoPlay: 3000, //Set AutoPlay to 3 seconds



		  });



		});

		</script>



        <script>

		$(document).ready(function() {



		  var owl = $("#owl-demo-3");



		  owl.owlCarousel({





			itemsCustom : [

			  [0, 1],

			  [450, 2],

			  [600, 3],

			  [700, 3],

			  [1000, 4],

			  [1200, 4],

			  [1400, 4],

			  [1600, 4]

			],

			navigation : true,

			autoPlay: 3000, //Set AutoPlay to 3 seconds



		  });



		});

		</script>



     <script>

		$(document).ready(function() {



		  var owl = $("#owl-demo-4");



		  owl.owlCarousel({





			itemsCustom : [

			  [0, 1],

			  [450, 1],

			  [600, 1],

			  [700, 1],

			  [1000, 1],

			  [1200, 1],

			  [1400, 1],

			  [1600, 1]

			],

			navigation : true,

			autoPlay: 3000, //Set AutoPlay to 3 seconds



		  });



		});

		</script>

   <script>

$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
        || location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             $('html,body').animate({
                 scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
});

</script>



<?php wp_footer(); ?>



</body>

</html>
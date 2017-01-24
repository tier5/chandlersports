<?php
/**
 * The footer.
 *
 */
?>


<div class="clear"></div>

<?php if(!get_theme_mod('ig_footer_sidebar')) : ?>
	<footer class="padding_footer_column">
		<div class="container">
			<div class="row column">
				<?php //loads sidebar-footer.php
					get_sidebar( 'footer' );
				?>
	          </div><!--  row -->
	    </div><!-- .container-->
	</footer>
<?php endif; ?>



<!-- Widget Welcome Text -->

<div class="ig-container">
	<div class="ig-cont-below-area">
		<?php  if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('below-post-sidebar') ) ?>
	</div>
</div>



	<div id="instagram-footer">
		<?php  if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('instagram_footer') ) ?>
	</div>




		<!-- Back To Top -->

				<a href="#0" class="cd-top">
					<i class="fa fa-angle-up"></i>
				</a>

		<!-- Back To Top -->








<div class="sub_footer">
	          <div class="textaligncenter text_footer">

		&copy; <?php echo date('Y'); ?>
		<?php echo wp_kses_post(get_theme_mod('ig_footer_copyright')); ?>

			</div>
</div><!-- .sub_footer-->




<!-- =============== //WORDPRESS FOOTER HOOK // =============== -->
<?php if(!get_theme_mod('ig_disable_loading')) : ?>
	<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(".animsition").animsition({
					inClass: 'fade-in',
					outClass: 'fade-out',
					inDuration: 1500,
					outDuration: 800,
					linkElement: 'a:not([target="_blank"]):not([href^="#"]):not([class="no-animation"]):not([class="woocommerce-main-image"]):not([href*=".gif"]):not([href*=".mov"]):not([href*=".swf"]):not([href*=".jpg"]):not([href*=".jpeg"]):not([href*=".png"])',
					// e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
					loading: true,
					loadingParentElement: 'body', //animsition wrapper element
					loadingClass: 'animsition-loading',
					unSupportCss: [
					'animation-duration',
					'-webkit-animation-duration',
					'-o-animation-duration'
					],
					//"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
					//The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
					overlay : false,
					overlayClass : 'animsition-overlay-slide'
					//overlayParentElement : 'body'
				});
			});
		</script>
<?php endif; ?>


<?php if(!get_theme_mod('ig_disable_sticky_sider')) : ?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			"use strict";
			jQuery('.main_content__r, .sticky_sider').theiaStickySidebar({
				// Settings
				additionalMarginTop: 80
			});
		});
	</script>
<?php endif; ?>


<script type="text/javascript">
	jQuery(document).ready(function() {
		if( jQuery('.floating-labels').length > 0 ) floatLabels();

		function floatLabels() {
			var inputFields = jQuery('.floating-labels .cd-label').next();
			inputFields.each(function(){
				var singleInput = jQuery(this);
				checkVal(singleInput);
				singleInput.on('change keyup', function(){
					checkVal(singleInput);
				});
			});
		}

		function checkVal(inputField) {
			( inputField.val() == '' ) ? inputField.prev('.cd-label').removeClass('float') : inputField.prev('.cd-label').addClass('float');
		}
	});
</script>




<?php wp_footer();?>

<?php if(!get_theme_mod('ig_disable_loading')) : ?>
	</div> <!--  end class animsition !-->
<?php endif; ?>

</body>
</html>
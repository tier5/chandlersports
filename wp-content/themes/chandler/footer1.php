		<?php if(!is_checkout()) :?>
			<br style="clear: both;" />

						<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 social-links hidden-xs">
							<div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 social-link-ind">
							<a class="facebook_logo" href="https://www.facebook.com/pages/Chandler-Sports/465752946790356?ref=ts&fref=ts" target="_blank">

							<img class="img-responsive facebook_logo_img" src="/wp-content/themes/chandler/images/facebook.png" class="sociallink" border="0" />

							<img class="img-responsive facebook_small_img" src="/wp-content/themes/chandler/images/1432897483_square-facebook.png" class="sociallink" border="0" style="display:none;" />


							</a>
							</div>
							<!-- <a href="http://www.twitter.com/chandler_sports" target="_blank"><img src="/wp-content/themes/chandler/images/twitter.png" class="sociallink" border="0" /></a> -->
							<div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 social-link-ind">
							<a  class="google_logo" href="https://plus.google.com/104263035271660173542/posts" target="_blank">

							<img class="img-responsive google_logo_img" src="/wp-content/themes/chandler/images/gplus.png" class="sociallink" border="0" /></a>

							<img class="img-responsive google_logo_small" src="/wp-content/themes/chandler/images/1432897537_square-google-plus.png" class="sociallink" border="0" style="display:none;"/></a>

							</div>
							<div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 social-link-ind">
							<a class="youtube_logo" href="http://www.youtube.com/user/chandlersports" target="_blank">
							<img class="img-responsive youtube_logo_img" src="/wp-content/themes/chandler/images/youtube.png" class="sociallink" border="0" style="margin: 0 !important;" />

							<img class="img-responsive youtube_small_img" src="/wp-content/themes/chandler/images/small-youtube.png" class="sociallink" border="0" style="display:none;margin: 0 !important;" />

							</a>
							</div>
						</div>


                    <!--used for responcive-->
                      <div class="social-links1 visible-xs">
							<div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 social-link-ind">
							<a class="facebook_logo" href="https://www.facebook.com/pages/Chandler-Sports/465752946790356?ref=ts&fref=ts" target="_blank">

							<img class="img-responsive facebook_logo_img" src="/wp-content/themes/chandler/images/facebook.png" class="sociallink" border="0" />

							<img class="img-responsive facebook_small_img" src="/wp-content/themes/chandler/images/1432897483_square-facebook.png" class="sociallink" border="0" style="display:none;" />


							</a>
							</div>
							<!-- <a href="http://www.twitter.com/chandler_sports" target="_blank"><img src="/wp-content/themes/chandler/images/twitter.png" class="sociallink" border="0" /></a> -->
							<div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 social-link-ind">
							<a  class="google_logo" href="https://plus.google.com/104263035271660173542/posts" target="_blank">

							<img class="img-responsive google_logo_img" src="/wp-content/themes/chandler/images/gplus.png" class="sociallink" border="0" /></a>

							<img class="img-responsive google_logo_small" src="/wp-content/themes/chandler/images/1432897537_square-google-plus.png" class="sociallink" border="0" style="display:none;"/></a>

							</div>
							<div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 social-link-ind">
							<a class="youtube_logo" href="http://www.youtube.com/user/chandlersports" target="_blank">
							<img class="img-responsive youtube_logo_img" src="/wp-content/themes/chandler/images/youtube.png" class="sociallink" border="0" style="margin: 0 !important;" />

							<img class="img-responsive youtube_small_img" src="/wp-content/themes/chandler/images/small-youtube.png" class="sociallink" border="0" style="display:none;margin: 0 !important;" />

							</a>
							</div>
						</div>


		<?php endif; ?>
		
	</div>
	
	<div id="footer" class="col-lg-12 col-xs-12 col-sm-12 col-md-12 footer-c">
		<?php dynamic_sidebar('footer-widget-area'); ?>
	</div>
	
	<div id="legalbit" class="col-lg-12 col-xs-12 col-sm-12 col-md-12 legalbit-c">

		<?php if(!is_checkout()): ?>
		<center><img class="img-responsive" src="/wp-content/themes/chandler/images/weaccept.png" alt="we accept" id="weaccept" /></center>
		<?php endif; ?>

		<p id="copy">&copy; Chandler Sports : All rights reserved </p>
		<p id="inigo">Site by <a href="http://www.inigo.net" target="_blank">Inigo</a></p>
	</div>

</div>

</div>
</div>

<script type="text/javascript">
/*jQuery('#testimonailwidget-2').hover(function(){
jQuery('.widget-line').css({'border-bottom':'2px solid #333','margin-bottom':'20px','transition':'all 0.25s ease-in-out 0s','width':'20'});
});*/

jQuery( "#testimonailwidget-2" ).mouseenter(function() {
jQuery('.testimonial-widget-line').css({'border-bottom':'2px solid #4aa246','margin-bottom':'20px','transition':'all 0.25s ease-in-out 0s','width':'40%'});
}); 


jQuery( "#testimonailwidget-2" ).mouseleave(function() {
jQuery('.testimonial-widget-line').css({'border-bottom':'2px solid #333','width':'20%'});
});




</script>





<?php wp_footer(); ?>

</body>
</html>
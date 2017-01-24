<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	
	<div id="page">
		<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
		<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
		</script>
	</div>
	
	<div id="pageside">
	
		<div class="side_icons">
			<a href="https://www.facebook.com/chandlersports?ref=ts&fref=ts"><img src="/wp-content/themes/chandler/images/fb-btn.png" border="0" /></a> 
			<a href="https://plus.google.com/+ChandlersportsCoUk/posts"><img src="/wp-content/themes/chandler/images/gplusbtn.png" border="0" /></a>
		</div>
		
	</div>
	
	<br style="clear: both;" />	

<?php get_footer(); ?>
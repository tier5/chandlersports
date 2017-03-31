<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	
	<div class="container">
	<div id="page">
		<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
		<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
		</script>
	</div>
	
	
	</div>
	
	<br style="clear: both;" />	

<?php get_footer(); ?>
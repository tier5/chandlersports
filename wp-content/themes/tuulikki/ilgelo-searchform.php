<?php
/**
* The template for displaying search forms
*
*/
?>


<div class="container_search search_close">
	<div class="container">
		<section class="alignright" id="top-search">
			<a class="click_search " href="#0"><i class="fa fa-times"></i></a>
		</section>
	</div>

	<div class="panel-body">

		<div class="container">
			<div class="widget_search" style="margin-top: 20%;">
				<form role="search" method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" class="search-field big_search" placeholder="<?php echo esc_attr_x( __( 'Search', 'ilgelo' ), 'placeholder', '' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( '', 'label', '' ); ?>">
				</form>
			</div><!-- widget_search -->
		</div><!--  END container -->
		
	</div><!--  END panel-body -->
</div><!--  END container_search -->





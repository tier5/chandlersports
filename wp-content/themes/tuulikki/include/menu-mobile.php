


<div class="container_menu menu_close">
	
	
<div class="container">
	<section class="alignright" id="top-resp-menu">
		<a class="click_menu" href="#0"><i class="fa fa-times"></i></a>
	</section>
</div>


<?php wp_nav_menu(array(
					'container' => 'ul',
					'theme_location' => 'mobile_menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'menu_class'      => 'nav-mobile',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'depth'           => 3,
					'walker'          => ''
     )
  );
?>

<!-- ==== Social Icon ======== -->
<?php if(!get_theme_mod('ilgelo_social_active')) : ?>
	<div class="textaligncenter resp-social">
		<?php include(TEMPLATEPATH."/include/social-icons.php"); ?>
	</div><!-- .ig-social -->
<?php endif; ?>


<div class="resp-search">
		<div class="panel-body">

		<div class="container">
			<div class="widget_search" style="margin-top: 20%;">
				<form role="search" method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" class="search-field big_search" placeholder="<?php echo esc_attr_x( __( 'Search', 'ilgelo' ), 'placeholder', '' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( '', 'label', '' ); ?>">
				</form>
			</div><!-- widget_search -->
		</div><!--  END container -->
		
	</div><!--  END panel-body -->
</div><!--  END resp-search -->


</div>
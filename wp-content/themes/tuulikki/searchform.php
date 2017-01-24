<?php
/**
 * The template for displaying search forms 
 *
 */
?>

<div class="widget_search">

      <form role="search" method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>">

            <input type="search" class="search-field big_search" placeholder="<?php echo esc_attr_x( __( 'Search and hit enter &hellip;', 'ilgelo' ), 'placeholder', '' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( '', 'label', '' ); ?>">
	
      </form>
      
      
</div>
<?php wp_footer();?>

<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>

<!----<div class="main_banner innerpage-image" style="background: transparent url('http://testweb4you.com/projects/chandlersports/wp-content/uploads/2016/04/in_bg.jpg') no-repeat scroll center center / cover;">
	<section class="section single-wrap">
    	<div class="container">
        	<div class="page-title">
                    <div class="row">
                        <div class="col-sx-12 text-center">
                            <h3><?php the_title(); ?></h3>
                            <div class="bread">
                                <ol class="breadcrumb">
                                  <li><a href="http://testweb4you.com/projects/chandlersports/">Home</a></li>
                                  <li class="active"><?php the_title(); ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>--->

<div class="container" style="margin-bottom:20px; margin-top:20px;">
<div class="contnet-font-style">
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>


	<div class="col-lg-6 col-sm-12 col-md-6 col-xs-12 outer-summary-productside">

	<div class="summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
		<!--<div id="product-side" class="">
		<div class="head-widget">
			<img src="/wp-content/themes/chandler/images/map.png" class="product-side-img" style="margin-left: -10px;" />
			<p><img src="/wp-content/themes/chandler/images/van.png" /><br />The "SUPER SAVER" free delivery and installation over £100.00</p>
		</div>

		<div class="product-widget">
			<img src="/wp-content/themes/chandler/images/tags.png" class="product-side-img" /><p>Best Price Promise - Call for our best offers - silly not to!</p>
		</div>

		<div class="product-widget">
			<img src="/wp-content/themes/chandler/images/tools.png" class="product-side-img" /><p>We repair, service and install fitness equipment UK wide</p>
		</div>

		<div class="product-widget">
			<img src="/wp-content/themes/chandler/images/phone.png" class="product-side-img" /><p>Phone Kurt for advice on our services or products</p>
		</div>

		<div class="product-widget">
			<img src="/wp-content/themes/chandler/images/lock.png" class="product-side-img" /><p>We use SagePay and PayPal for convenient secure payments</p>
		</div>

		<div class="product-widget">
			<img src="/wp-content/themes/chandler/images/smallhire.png" class="product-side-img" /><p>Not sure on the product - hire it from us to try out</p>
		</div>

		<div class="product-widget">
			<img src="/wp-content/themes/chandler/images/33percent.png" class="product-side-img" /><p>33% of the total hire off the list price - truly a bargain!</p>
		</div>

	</div>-->

	</div><!-- .summary -->





</div>
</div><!-- /.row -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->
</div>
</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>

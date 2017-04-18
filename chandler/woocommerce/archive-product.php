<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_header('shop');
?>
<style>
.nav-previous {
    
    margin-right: 25%;
}
.nav-next {
    width: 30%;
    float: right;
    /* right: 0; */
    /* position: relative; */
    display: inline;
}
</style>
<?php
/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');
?>

<div class="main_banner innerpage-image inner-category-select-title">
	<section class="section single-wrap">
		<div class="container">
			<div class="page-title">
				<div class="row">
					<div class="col-sx-12 text-center">
						<h3><?php if ( is_search() ) : ?>
								<?php
								printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
								if ( get_query_var( 'paged' ) )
									printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
								?>
							<?php elseif ( is_tax() ) : ?>
								<?php echo single_term_title( "", false ); ?>
							<?php else : ?>
								<?php
								$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

								echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
								?>
							<?php endif; ?></h3>
						<div class="bread">
							<ol class="breadcrumb all-final-set-category">
								<li><a href="http://testweb4you.com/projects/chandlersports/">Home</a></li>
								<li class="active"><?php if ( is_search() ) : ?>
										<?php
										printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
										if ( get_query_var( 'paged' ) )
											printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
										?>
									<?php elseif ( is_tax() ) : ?>
										<?php echo single_term_title( "", false ); ?>
									<?php else : ?>
										<?php
										$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

										echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
										?>
									<?php endif; ?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php
if (is_product_category()){
	global $wp_query;
	// get the query object
	$cat = $wp_query->get_queried_object();
	// get the thumbnail id user the term_id
}
?>
<?php if(get_field('slider', 'product_cat_'.$cat->term_id.'') != NULL): ?>
	<div id="slides">
		<div class="slides_container">
			<?php while(the_repeater_field('slider', 'product_cat_'.$cat->term_id.'')): ?>
				<div style="background-image: url(<?php echo get_sub_field('image'); ?>);">
					<div id="brandlogo">
						<?php if(get_sub_field('brand_logo')): ?>
							<img src="<?php echo get_sub_field('brand_logo'); ?>" />
						<?php endif; ?>
					</div>
					<div id="content">
						<?php if(get_sub_field('slide_link') == 1): ?>
							<a href="<?php echo get_sub_field('buy_now_link'); ?>" class="entirebuy"></a>
						<?php endif; ?>

						<?php if(get_sub_field('title') != NULL): ?>
							<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
						<?php endif; ?>
						<?php if(get_sub_field('price') != NULL): ?>
							<p id="slideprice"><?php echo get_sub_field('price'); ?></p>
						<?php endif; ?>
						<?php if(get_sub_field('slide_link') != 1): ?>
							<?php if(get_sub_field('buy_now_link') != NULL): ?>
								<a href="<?php echo get_sub_field('buy_now_link'); ?>" class="buynowlink">Buy Now</a>
							<?php endif; ?>
						<?php endif; ?>
						<?php if(get_sub_field('buy_now_link') != NULL): ?>
							<a href="<?php echo get_sub_field('buy_now_link'); ?>" class="hirenowlink"><?php echo get_sub_field('hire_text'); ?></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>


<!--<div class="catg_main mian-cate-all-final">
	<div class="container">
    	<div class="tre_title">

         <?php do_action( 'woocommerce_archive_description' ); ?>

	<?php if ( is_tax() ) : ?>
		<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
	<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
		<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
	<?php endif; ?>


</div>
</div>
</div>

<div class="catg_main mian-cate-all-final">
<div class="container">
<div class="ab_box">

		    <?php
if (is_product_category()){
	global $wp_query;
	// get the query object
	$cat = $wp_query->get_queried_object();
	// get the thumbnail id user the term_id
}
if(the_field('bottom_description', 'product_cat_'.$cat->term_id.'')){
	?>
			<div class="bottomd-class">

              <?php  the_field('bottom_description', 'product_cat_'.$cat->term_id.''); ?>

            </div>
			<?php
}
?>
</div>
</div>
</div>-->





<?php if ( have_posts() ) : ?>

<?php do_action('woocommerce_before_shop_loop'); ?>
	
				<?php 
					$queried_object = get_queried_object(); 
					$taxonomy = $queried_object->taxonomy;
					$term_id = $queried_object->term_id;  

				?>

	<div class="container">
		
		<div class="row">
			<div class="col-sm-12">
				<div class="breadcrumbs-wrapper" style="margin-bottom: 0 !important;">
					<?php woocommerce_breadcrumb() ?>
				</div>
			</div>
		</div>
		
		<div class="row cat-des-header"><hr class="cat-des-header-top"/>
			<div class="col-sm-6">
				<h1><?php single_term_title(); ?></h1>
				<?php echo category_description( $category_id ); ?> 

				 <button type="button" class="collapsed mobBtn btn " data-toggle="collapse" data-target="#more-text" id="prod_readmore_button"> 
		               <?php echo get_field('description_read_more_link_text', $taxonomy . '_' . $term_id); ?>
					 
		            </button>
		            
		    
		            
		            
		            
		            
			</div>
			<div class="col-sm-6">
			<img class="cat-img" src="<?php the_field('description_image', $taxonomy . '_' . $term_id); ?>" border="0">
			
			
				
			</div>
			
			<hr class="cat-des-header-bot"/>
		</div>
		
		<div id="more-text" class="collapse mob-menu">
				<?php the_field('bottom_description', $taxonomy . '_' . $term_id); ?>
			</div>	
		
		<div class="row cat-row">
			
			<div class="col-md-9 pull-right">
				<ul class="products">

					<?php woocommerce_product_subcategories(); ?>

					<?php $i=1; while ( have_posts() ) : the_post(); global $post, $product; ?>
						<?php //woocommerce_get_template_part( 'content', 'product' ); ?>

						<?php if(is_search()): ?>
							<li class="archive-product-li col-lg-3 col-xs-12 col-sm-4 col-md-3 product1">
								<div class="pr_box_search-box-all">
									<div class="post searchresults">

										<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), array(220,220)); ?>
										<div class="search-img">
											<?php if($image[0] != NULL): ?>
												<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
											<?php endif; ?>
										</div>

										<div class="search-info pr_tit-search-box">
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<p class="theprice search-box-price"><h2><?php echo $product->get_price_html(); ?></h2></p>
											<!--p class="normalprice">Normal price &pound;<?php echo $woocommerce->regular_price; ?></p-->
											<?php /* ?><p style="text-align: left;"><a href="<?php the_permalink(); ?>" class="thebuylink">Buy</a></p><?php */ ?>
											<a class="add-to-cart btn" href="<?php the_permalink(); ?>"><i class="fa fa-shopping-cart"></i>Buy</a>
										</div>

									</div>
								</div>
							</li>
						<?php else: ?>
							<li class="archive-product-li col-lg-4 col-xs-12 col-sm-4 col-md-4 product<?php echo $i; ?>">
								<div class="pr_box_01 match-height">

									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), array(220,170)); ?>


									<div class="prod-top">
										<div class="im_br">
											<?php if($image[0] != NULL): ?>
												<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" border="0" /></a>
											<?php endif; ?>
											
											<div class="prod_flags">
												
												<div class="saleup">
													<?php if($product->sale_price != NULL): ?>
														<a class="add-to-cart_1 btn" href="#">
															sale
														</a>
													<?php endif; ?>

												</div>
												
												
		<?php $hide = get_field('hide'); if( $hide && in_array('hide-free-ship', $hide) ): ?> <?php else: ?>
						<div class="delivery">
								<a class="add-to-cart_1 btn" href="<?php the_permalink(); ?>">
									Free Delivery
								</a>
						</div>
		<?php endif; ?>
												
												<div class="finance"><?php if( get_field('hire_per_week_price' ) ): ?>
														<a class="add-to-cart_1 btn" href="<?php the_permalink(); ?>">
															Finance
														</a>
													<?php endif; ?>
												</div>
												
												<div class="finally-change-btn"><?php if( get_field('hire_per_week_price' ) ): ?>
														<a class="add-to-cart_1 btn" href="<?php the_permalink(); ?>">
															Hire
														</a>
													<?php endif; ?>
												</div>
												
											</div>

										</div>
									</div>
									<div class="pr_tit cf">

										<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
										
										<div class="str_box">
											<?php my_print_stars(); ?>
										</div>
										
										
										<div class="pr_b_left">
											<?php if($product->regular_price != NULL): ?>
												<h2><?= $product->sale_price ? 'RRP ' : '' ?>&pound;<?php echo $product->regular_price; ?><?= $product->sale_price ? '</s>' : '' ?></h2>
											<?php else: ?>
												<span style="font-weight: bold;">Click for Prices</span><br />
											<?php endif; ?>
											<?php if($product->sale_price != NULL): ?>
												<h3>Our Price &pound;<?php echo $product->sale_price; ?></h3>
											<?php endif; ?>
										</div>
										<div class="pr_b_right">
											<h2><?php echo get_field('hire_per_week_price'); ?></h2><h3>per week</h3>
										</div>
										

									</div>
									<div class="but_n">

										<?php /* ?><a class="add-to-cart btn" href="<?php the_permalink(); ?>"><i class="fa fa-shopping-cart"></i>Buy<span style="padding-left: 5px;padding-right: 5px;">/</span><i class="fa fa-clock-o"></i>hire</a><?php */ ?>

										<a class="add-to-cart btn" href="<?php the_permalink(); ?>">Add to basket</a>

										<?php if(get_field('hire_per_week_price') != NULL): ?>

											<?php /* ?><a class="add-to-cart_1 btn" href="<?php the_permalink(); ?>"><i class="fa fa-clock-o"></i>hire</a><?php */ ?>

										<?php endif; ?>
									</div>
								</div>
							</li>

						<?php endif; ?>
						<?php //if($i==4): echo '<span class="keyline"></span>'; endif; ?>
						<?php  if($i==3): $i=1; else: $i++; endif; endwhile; // end of the loop. ?>

				</ul>
			</div>
			
			
			<div class="col-md-3 cat-side">
				<div class="prod-cat-side">
				  
				  <div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-6">
					    <div class="clearance side-ad">
							<h3><?php the_field('clearance_title' , options); ?></h3>
							<p>
								<img src="<?php the_field('clearance_image' , options); ?>" alt="<?php the_field('clearance_title'); ?>"/>
								<a class="readmore" href="<?php the_field('clearance_link' , options); ?>" title="Shop online">
								<?php the_field('clearance_link_title' , options); ?>
								</a>
							</p>
						</div>
					</div>

					  <div class="col-lg-12 col-md-12 col-sm-6">
						  <div class="finance side-ad">
								<h3><?php the_field('finance_title' , options); ?></h3>

								<p>
									<img src="<?php the_field('finance_image' , options); ?>" alt="<?php the_field('finance_title' , options); ?>"/>
									<a class="readmore" href="<?php the_field('finance_link' , options); ?>" title="Shop online">
									<?php the_field('finance_link_title' , options); ?></a>
								</p>
							</div>
						</div>
					</div>
					
					<div class="delivery side-ad">
						<p><img src="/wp-content/themes/chandler/images/lorry.png" width="120" height="99" alt=""/></p>
						<h4><?php the_field('shipping_title' , options); ?></h4>
						<?php the_field('shipping_text' , options); ?>
						
					</div>
					
				</div>
				
			</div>
			
			
		</div>
		
	</div>

<div class="upsells">


	<?php //do_action('woocommerce_after_shop_loop'); ?>

	<?php else : ?>

		<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

			<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>

		<?php endif; ?>

	<?php endif; ?>

	<div class="clear"></div>
	<div class="row cat-row">						
<div class="col-md-4 cat-side"></div>
<div class="col-md-8 pull-right">
	<?php
	/**
	 * woocommerce_pagination hook
	 *
	 * @hooked woocommerce_pagination - 10
	 * @hooked woocommerce_catalog_ordering - 20
	 */
	
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			
	?>
	</div></div>
	<?php
	/**
	 * woocommerce_after_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	//do_action('woocommerce_after_main_content');
	?>

	<?php
	/**
	 * woocommerce_sidebar hook
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action('woocommerce_sidebar');
	?>

	<?php get_footer('shop'); ?>

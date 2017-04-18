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
	<?php global $woocommerce, $product, $post, $comment; ?>
	<div class="container" style="margin-bottom:20px; margin-top:20px;">
		<div class="contnet-font-style">
			<?php do_action( 'woocommerce_before_single_product' ); ?>
			<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="row">
					<div class="col-sm-8">
						<div class="breadcrumbs-wrapper">
							<?php woocommerce_breadcrumb() ?>
						</div>
					</div>
					<div class="col-sm-4">
						<?php if(get_field('brand_logo')): ?>
						<div class="csnew_brandlogo">
							<img src="<?php echo get_field('brand_logo'); ?>" />
						</div>
						<?php endif; ?>
					</div>
					<hr class='prod-head-hr' />
				</div>
				
				<div class="row">
					<div class="col-sm-6">
						<?php if(get_field('product_video')): ?>
						<div class="csnew_youtube_video">
							
								<?php echo wp_oembed_get(get_field('product_video')); ?>
							
						</div>
						<?php else: ?>
								<span class="salesflag"></span>
								<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
							
						<?php endif; ?>
						
						
						
						
					</div>
					<div class="col-sm-6 csnew_content">
						<h1><?php the_title(); ?></h1>
						<div class="str_box"><?php my_print_starss(); ?> </div>
						<?php the_excerpt(); ?>
						<p class="csnew_readmore"><a href="#tabs-link">Read more &gt;</a></p>
						
						<div class="row">
							<div class="col-md-3">
								<?php if($product->sale_price != NULL): ?>
									<p id="csnew_rrp">RRP <span>&pound;<?php echo $product->regular_price; ?></span></p>
									<p id="csnew_sale_price">&pound;<?php echo $product->sale_price; ?></p>
								<?php else: ?>
									<p id="rrpnot">
										<?php if(get_field('recommended_retail_price')): ?>
											<span>&pound;<?php the_field('recommended_retail_price'); ?></span>
										<?php endif; ?> 
										<span>&pound;<?php echo $product->regular_price; ?></span>
									</p>
								<?php endif; ?>
							</div>
							<div class="col-md-9 csnew_qty">
								<?php if ( $product->is_in_stock() ) : ?>
									<?php do_action('woocommerce_before_add_to_cart_form'); ?>
									<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
										<?php 
											do_action('woocommerce_before_add_to_cart_button');
											if ( ! $product->is_sold_individually() )
											woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity() ) );
										?><button type="submit" class="single_add_to_cart_button button alt">Add to basket</button>
										<?php do_action('woocommerce_after_add_to_cart_button'); ?>
									</form>
									<?php do_action('woocommerce_after_add_to_cart_form'); ?>
								<?php endif; ?>
								<img src="/wp-content/themes/chandler/images/cards.jpg" />
							</div>
						</div>

					</div>
					
					
					<?php if(get_field('product_video')): ?>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<span class="csnew_hr"></span>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
						<span class="salesflag"></span>
						<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
					</div>
					
					<div class="col-lg-6 col-sm-12 col-md-6 col-xs-12 outer-summary-productside">
					<?php else: ?>
					<div class="col-lg-6 col-sm-12 col-md-6 col-xs-12 outer-summary-productside summary-productside-novid">
					<?php endif; ?>
						<div class="summary">
							
							<div class="csnew_saver">
								<p><strong>We deliver to the whole of mainland UK</strong></p>
								<img src="/wp-content/themes/chandler/images/lorry.png" /><p>Free <span>SUPER SAVER</span> Delivery &amp; Installation for most of Scotland and 
								Northern England</p>
								<p><a href="/delivery-map/" target="_blank">Click for more details</a></p>
							</div>
							
							<div id="hiretabs" class="csnew_hiretabs">
								<ul>
									<?php if(get_field('finance_per_term_price')): ?>
									<li><a href="#tabs-1"><?php the_field('finance_per_term_price'); ?></a></li>
									<?php endif; ?>
									<?php if(get_field('hire_per_week_price')): ?>
									<li><a href="#tabs-2"><?php the_field('hire_per_week_price'); ?></a></li>
									<?php endif; ?>
								</ul>
								<?php if(get_field('finance_per_term_price')): ?>
								<div id="tabs-1">
									<div class="row">
										<div class="col-sm-8">
											<p>Finance Calculator</p>
										</div>
									</div>
								</div>
								<?php endif; ?>
								<?php if(get_field('hire_per_week_price')): ?>
								<div id="tabs-2">
									<?php echo do_shortcode('[gravityform id=10 title="false" description="false"]'); ?>
								</div>
								<?php endif; ?>
							</div>
							
							<div class="product_share"><label>Share this ></label> <?php social_share(); ?></div>
							
							
							<?php //do_action( 'woocommerce_single_product_summary' ); ?>
						</div>
						
					</div>
					
					
				</div>
				
				
				
				<div class="row">
					<div class="col-sm-12"><div id="tabs-link"></div>
						<div id="tabs" class="csnew_tabs">
							<ul>
								<li><a href="#tabs-1">Description</a></li>
								
								<?php if(get_field('delivery_and_returns')): ?>
								<li><a href="#tabs-2">Delivery &amp; Returns</a></li>
								<?php endif; ?>
								
								
								
								<?php if(get_field('warranty')||
										 get_field('frame_warranty')||
										 get_field('computer_warranty')||
										 get_field('brake_warranty')||
										 get_field('plastic_warranty')||
										 get_field('motor_warranty')||
										 get_field('labour_warranty')): ?>
								<li><a href="#tabs-3">Warranty</a></li>
								<?php endif; ?>
								
								
								
								
								<?php if(get_field('specifications')||
										 get_field('features') ||
										 get_field('features') ||
										 get_field('lcd_backlight')||
										 get_field('number_of_programmes')||
										 get_field('batteries_required')||
										 get_field('qty_batteries_required')||
										 get_field('mains_power_required')||
										 get_field('mains_voltage')||
										 get_field('adapter_used')): ?>
							
							
								<li><a href="#tabs-4"><?php if(get_field('features')): ?>Features/<?php endif; ?>Specifications</a></li>
								<?php endif; ?>
								
								
								
								
								
								
								
								
								
								
								<?php if(get_field('setup_length') || 
										 get_field('setup_width') ||
										 get_field('setup_height')||
										 get_field('folded_width')||
										 get_field('folded_height') ||
										 get_field('transport_wheels')||
										 get_field('folding_action')||
										 get_field('user_weight_limit')||
										 get_field('max_load')||
										 get_field('certification_class')||
										 get_field('assembly_required')
										): ?>
								
										<li><a href="#tabs-4b">Dimensions & Setup</a></li>
									<?php endif; ?>
									
									
									
									
									
									<?php if(get_field('adjustment_type')||
											 get_field('levels_of_resistance')||
											 get_field('footplate_spec')||
											 get_field('crank_arm_stride_length')||
											 get_field('flywheel_weight')||
											 get_field('hp_rating')||
											 get_field('seat_height')||
											 get_field('running_belt')||
											 get_field('suspension')||
											 get_field('speed_range_distance_measure')||
											 get_field('speed_range_from')||
											 get_field('speed_range_to')||
											 get_field('incline_level')||
											 get_field('speaker_spec')||
											 get_field('computer_spec')||
											 get_field('handle_spec')||
											 get_field('weight_stack')): ?>
									
										<li><a href="#tabs-4c">Equipment</a></li>
									<?php endif; ?>
								
							
							
								
								
								<li><a href="#tabs-5">Reviews</a></li>
							</ul>
							<div id="tabs-1">
								<div class="row">
									<div class="col-lg-8 col-md-9 col-lg-offset-0">
										<?php the_content(); ?>
									</div>
								</div>
							</div>
							
							<?php if(get_field('delivery_and_returns')): ?>
								<div id="tabs-2">
									<h2>Delivery and returns</h2>
									<?php the_field('delivery_and_returns'); ?>
								</div>
							<?php endif; ?>
							
							<?php if(get_field('warranty')||
										 get_field('frame_warranty')||
										 get_field('computer_warranty')||
										 get_field('brake_warranty')||
										 get_field('plastic_warranty')||
										 get_field('motor_warranty')||
										 get_field('labour_warranty')): ?>
										 
							<div id="tabs-3">
								<h2>Warranty</h2>
								
								<?php if(get_field('frame_warranty')): ?>
											<p>Frame Warranty : <?php the_field('frame_warranty'); ?></p>
								<?php endif; ?>
									
								<?php if(get_field('computer_warranty')): ?>
											<p>Computer Warranty : <?php the_field('computer_warranty'); ?></p>
								<?php endif; ?>
								
								<?php if(get_field('brake_warranty')): ?>
											<p>Brake Warranty : <?php the_field('brake_warranty'); ?></p>
								<?php endif; ?>
									
								<?php if(get_field('plastic_warranty')): ?>
											<p>Plastic Warranty : <?php the_field('plastic_warranty'); ?></p>
								<?php endif; ?>
								
								<?php if(get_field('motor_warranty')): ?>
											<p>Motor Warranty : <?php the_field('motor_warranty'); ?></p>
								<?php endif; ?>
									
								<?php if(get_field('labour_warranty')): ?>
											<p>Labour Warranty : <?php the_field('labour_warranty'); ?></p>
								<?php endif; ?>
	
	
								<?php the_field('warranty'); ?>
								
								
								
								
								
								
							</div>
							<?php endif; ?>
							
								<?php if(get_field('specifications')||
										 get_field('features') ||
										 get_field('features') ||
										 get_field('lcd_backlight')||
										 get_field('number_of_programmes')||
										 get_field('batteries_required')||
										 get_field('qty_batteries_required')||
										 get_field('mains_power_required')||
										 get_field('mains_voltage')||
										 get_field('adapter_used')): ?>
										 
							<div id="tabs-4">
								<?php the_field('specifications'); ?>
								
								<?php if(get_field('features')): ?>
									<?php if(get_field('features')): ?>
											<h2>features</h2>
											<p><?php the_field('features'); ?></p>
										<?php endif; ?>

									<?php if(get_field('lcd_backlight')): ?>
											<p>LCD Backlight : <?php the_field('lcd_backlight'); ?></p>
									<?php endif; ?>

									<?php if(get_field('number_of_programmes')): ?>
											<p>Number Of Programmes : <?php the_field('number_of_programmes'); ?></p>
									<?php endif; ?>

									<?php if(get_field('number_of_programmes')): ?>
											<p>Programmes : <?php the_field('programmes'); ?></p>
									<?php endif; ?>
								<?php endif; ?>
								
								<?php if(get_field('batteries_required')): ?>
									<?php if(get_field('batteries_required')): ?>
											<h2>Electricals</h2>
											<p>Batteries Required : <?php the_field('batteries_required'); ?></p>
										<?php endif; ?>

									<?php if(get_field('qty_batteries_required')): ?>
											<p>Qty. Batteries Required : <?php the_field('qty_batteries_required'); ?></p>
									<?php endif; ?>
										
									<?php if(get_field('mains_power_required')): ?>
											<p>Mains Power Required : <?php the_field('mains_power_required'); ?></p>
									<?php endif; ?>
										
									<?php if(get_field('mains_voltage')): ?>
											<p>Mains Voltage : <?php the_field('mains_voltage'); ?></p>
									<?php endif; ?>
										
									<?php if(get_field('adapter_used')): ?>
											<p>Adapter Used : <?php the_field('adapter_used'); ?></p>
									<?php endif; ?>

										
	
	
	
	
							
							
								<?php endif; ?>
								
							</div>
							<?php endif; ?>
							
							
								<?php if(get_field('setup_length') || 
										 get_field('setup_width') ||
										 get_field('setup_height')||
										 get_field('folded_width')||
										 get_field('folded_height') ||
										 get_field('transport_wheels')||
										 get_field('folding_action')||
										 get_field('user_weight_limit')||
										 get_field('max_load')||
										 get_field('certification_class')||
										 get_field('assembly_required')
										): ?>
										
								<div id="tabs-4b">
									<h2>Dimensions</h2>
									<?php if(get_field('setup_length')): ?>
										<p>Length : <?php the_field('setup_length'); ?> cm</p>
									<?php endif; ?>
									
									<?php if(get_field('setup_width')): ?>
										<p>Width : <?php the_field('setup_width'); ?> cm</p>
									<?php endif; ?>
									
									<?php if(get_field('setup_height')): ?>
										<p>Height : <?php the_field('setup_height'); ?> cm</p>
									<?php endif; ?>
									
									<?php if(get_field('folded_width')): ?>
										<p>Folded Width : <?php the_field('folded_width'); ?> cm</p>
									<?php endif; ?>
									
									<?php if(get_field('folded_height')): ?>
										<p>Folded Height : <?php the_field('folded_height'); ?> cm</p>
									<?php endif; ?>
									
									
									
									<?php if(get_field('transport_wheels')): ?>
										<p>Transport Wheels : <?php the_field('transport_wheels'); ?></p>
									<?php endif; ?>
									<?php if(get_field('folding_action')): ?>
										<p>Folding Action : <?php the_field('folding_action'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('user_weight_limit')): ?>
										<p>User Weight Limit : <?php the_field('user_weight_limit'); ?> kg</p>
									<?php endif; ?>
									
									<?php if(get_field('max_load')): ?>
										<p>Max. Load : <?php the_field('max_load'); ?> kg</p>
									<?php endif; ?>
									
									<?php if(get_field('certification_class')): ?>
										<p>Certification : <?php the_field('certification_class'); ?> EN Class</p>
									<?php endif; ?>
									
									<?php if(get_field('assembly_required')): ?>
									<p>Assembly Required : <?php the_field('assembly_required'); ?></p>
									<?php endif; ?>
								
								
									
								</div>
								<?php endif; ?>
							
							
							
							
								<?php if(get_field('adjustment_type')||
											 get_field('levels_of_resistance')||
											 get_field('footplate_spec')||
											 get_field('crank_arm_stride_length')||
											 get_field('flywheel_weight')||
											 get_field('hp_rating')||
											 get_field('seat_height')||
											 get_field('running_belt')||
											 get_field('suspension')||
											 get_field('speed_range_distance_measure')||
											 get_field('speed_range_from')||
											 get_field('speed_range_to')||
											 get_field('incline_level')||
											 get_field('speaker_spec')||
											 get_field('computer_spec')||
											 get_field('handle_spec')||
											 get_field('weight_stack')): ?>
											 
								<div id="tabs-4c">
								
								
									<h2>Equipment</h2>
									<?php if(get_field('adjustment_type')): ?>
										<p>Adjustment Type : <?php the_field('adjustment_type'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('levels_of_resistance')): ?>
										<p>Levels of Resistance : <?php the_field('levels_of_resistance'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('footplate_spec')): ?>
										<p>Footplate Spec : <?php the_field('footplate_spec'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('crank_arm_stride_length')): ?>
										<p>Crank Arm / Stride Length : <?php the_field('crank_arm_stride_length'); ?> cm</p>
									<?php endif; ?>
									
									<?php if(get_field('flywheel_weight')): ?>
										<p>Flywheel Weight : <?php the_field('flywheel_weight'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('hp_rating')): ?>
										<p>HP Rating : <?php the_field('hp_rating'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('seat_height')): ?>
										<p>Seat Height : <?php the_field('seat_height'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('running_belt')): ?>
										<p>Running Belt : <?php the_field('running_belt'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('suspension')): ?>
										<p>Suspension : <?php the_field('suspension'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('speed_range_distance_measure')): ?>
										<p>Speed Range - Distance Measure : <?php the_field('speed_range_distance_measure'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('speed_range_from')): ?>
										<p>Speed Range From : <?php the_field('speed_range_from'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('speed_range_to')): ?>
										<p>Speed Range To : <?php the_field('speed_range_to'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('incline_level')): ?>
										<p>Incline Level : <?php the_field('incline_level'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('speaker_spec')): ?>
										<p>Speaker Spec : <?php the_field('speaker_spec'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('computer_spec')): ?>
										<p>Computer Spec : <?php the_field('computer_spec'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('handle_spec')): ?>
										<p>Handle Spec : <?php the_field('handle_spec'); ?></p>
									<?php endif; ?>
									
									<?php if(get_field('weight_stack')): ?>
										<p>Weight Stack : <?php the_field('weight_stack'); ?> kg</p>
									<?php endif; ?>
									
								
									
								</div>
								<?php endif; ?>
							
							
							
							
							
							
							
							
								<?php if(get_field('adjustment_type')): ?>
								<div id="tabs-4d">
								
								
									<h2>Equipment</h2>
									<?php if(get_field('adjustment_type')): ?>
										<p>Adjustment Type : <?php the_field('adjustment_type'); ?></p>
									<?php endif; ?>
									
									
								</div>
								<?php endif; ?>
							
							
							
							
							
							
							
							
							
							
							<div id="tabs-5">
								<p>
								<?php echo comments_template('woocommerce/single-product-reviews'); ?></p>
							</div>
							
						</div>
					</div>
				</div>
				
			</div>
			<div class="product_footer">
			<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
				</div>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_single_product' ); ?>

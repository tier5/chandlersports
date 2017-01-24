<?php
/**
* Template Name: Homepage 2014
*/

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?> 

<?php if(get_field('slider') != NULL): ?>
<div id="slides"> 
<div class="slides_container">
<?php while(the_repeater_field('slider')): ?> 
<div style="background-image: url(<?php echo get_sub_field('image'); ?>);">   
<!--<div id="brandlogo">
<?php if(get_sub_field('brand_logo')): ?>
	<img src="<?php echo get_sub_field('brand_logo'); ?>" /> 
<?php endif; ?>
</div>-->
<!--<div id="content">
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
<?php if(get_sub_field('hire_link') != NULL): ?>
	<a href="<?php echo get_sub_field('hire_link'); ?>" class="hirenowlink"><?php echo get_sub_field('hire_text'); ?></a> 
<?php endif; ?>
</div>-->
</div>
<?php endwhile; ?>
</div>
</div>
<?php endif; ?>
<div id="promises" class="col-lg-12 col-xs-12 col-sm-12 col-md-12 upper-promises">
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p>Best Price Promise | Call for our best deal</p>
	<span class="greendot first-greendot"></span>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p>Get expert advice on fitness equipment</p>
	<span class="greendot second-greendot"></span>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p class="last-child">Installation Service available UK wide</p>
	</div>
</div>


<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 kurt-home-products-outer">
<div id="kurt" class="col-lg-3 col-sm-3 col-xs-12 col-md-3 kurt-outer no-padding">	
	<h2>Fitness Equipment Services</h2> 	
	<ul>
		<li>
			<a href="<?php echo home_url();?>/gym-equipment-spare-parts-edinburgh/"><img src="/wp-content/themes/chandler/images/I1.jpg"></a>
			<a href="<?php echo home_url();?>/gym-equipment-spare-parts-edinburgh/">Spare Parts</a>
		</li>
		<li>
			<a href="<?php echo home_url();?>/commercial-gym-edinburgh/"><img src="/wp-content/themes/chandler/images/I2.jpg"></a>
			<a href="<?php echo home_url();?>/commercial-gym-edinburgh/">Repairs</a>
		</li>
		<li>
			<a href="<?php echo home_url();?>/commercial-gym-edinburgh/cabling-services/"><img src="/wp-content/themes/chandler/images/I3.jpg"></a>
			<a href="<?php echo home_url();?>/commercial-gym-edinburgh/cabling-services/">Cabling Service</a>
		</li>
		<li>
			<a href="<?php echo home_url();?>/commercial-gym-edinburgh/upholstery-repairs/"><img src="/wp-content/themes/chandler/images/I4.jpg"></a>
			<a href="<?php echo home_url();?>/commercial-gym-edinburgh/upholstery-repairs/">Upholstery</a>
		</li>
		<li>
			<a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/"><img src="/wp-content/themes/chandler/images/I5.jpg"></a>
			<a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/">Service &amp; Maintenance Contracts</a>
		</li>
		<li>
			<a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/delivery-installations-relocation/"><img src="/wp-content/themes/chandler/images/I6.jpg"></a>
			<a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/delivery-installations-relocation/">Delivery, Installation &amp; Relocation</a>
		</li>
	</ul> 
	
	<!--<img src="/wp-content/themes/chandler/images/kurt.png" />-->
	<!--<p id="greenarrow"><a href="/blog/">Chandler Sports Blog</a></p>-->
	
	<?php the_content(); ?>

	<!-- <h3>Welcome to Chandler Sports!</h3>
	<p class="kurtmap">Here you'll find a range of services, the latest products and all the information you need to help you find what you are looking for.</p> -->
	 
	
	<br  style="clear: both;" />
	
</div>

<div id="homeproducts" class="col-lg-9 col-xs-12 col-sm-9 col-md-9 home-products-outer no-padding">
	<?php if(get_field('products') != NULL): ?>
		<?php $i=1; while(the_repeater_field('products')): ?>
			<div class="col-lg-4 col-xs-12 col-sm-4 col-md-4 aproduct aproduct<?php echo $i; ?>">
				<a href="<?php echo get_sub_field('buy_link'); ?>"><img class="img-responsive" src="<?php echo get_sub_field('image'); ?>" border="0" /></a>
				<h3><a href="<?php echo get_sub_field('buy_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
				
				<div class="abuy">
					<a href="<?php echo get_sub_field('buy_link'); ?>">Buy</a>
					<br style="clear: both;" />
					<?php if(get_sub_field('sale_price')): ?><strike><?php endif; ?><?php echo get_sub_field('rrp'); ?><?php if(get_sub_field('sale_price')): ?></strike><?php endif; ?><br />
					<?php if(get_sub_field('sale_price')): ?>
						<span class="bigred">Sale <?php echo get_sub_field('sale_price'); ?></span><br />
					<?php endif; ?>
				</div>
				
				<?php if(get_sub_field('hire_link') != NULL): ?>
					<div class="ahire">
						<a href="<?php echo get_sub_field('hire_link'); ?>">Hire</a>
						<br style="clear: both;" />
						<span><?php echo get_sub_field('hire_price'); ?><i>per week</i></span>
					</div>
				<?php endif; ?>
				
				<p class="desc_p"><?php echo get_sub_field('kurt_says'); ?></p>
				
			</div>
			
		<?php $i++; endwhile; ?>
	<?php endif; ?>
</div>

</div><!-- Outside Kurt Home Products-->



<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 fitness-equipment-outer">				
		<!--<h2>Home Fitness Equipment</h2>-->
		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 fitness-row">
		<?php if(get_field('home_fitness_equipment') != NULL): ?>
			<?php $i=1; while(the_repeater_field('home_fitness_equipment')): ?>
				<div class="col-lg-3 col-xs-12 col-sm-3 col-md-3 fitness<?php echo $i; ?>">
					<a href="<?php echo get_sub_field('page_link'); ?>"><img class="img-responsive" src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
					<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
						<?php 
							/*if(get_sub_field('home_product_categories')):
								echo '<ul class="childfit">';
								//echo '<li>View all '.get_sub_field('title').'</li>';
								$child = get_sub_field('home_product_categories'); 
								foreach($child as $aterm):
									$term = get_term($aterm, 'product_cat'); 
									$alink = get_term_link($term);
									
									//echo '<li><a href="'.$alink.'">'.$term->name.'</a></li>';
									echo '<li>'.$term->name.'</li>';
								endforeach;
								echo '</ul>';
							endif;*/
						?>
				</div>
			<?php if($i==4): $i=1; echo '<br style="clear: both;" />'; else: $i++; endif; endwhile; ?>
		<?php endif; ?>
	</div>
</div>	
<?php if(get_field('commercial_gym_supply') != NULL): ?>
<div class="commercial-fitness col-lg-12 col-xs-12 col-sm-12 col-md-12">				
<h2>Commercial Gym Supply</h2>

<?php $closed = true; $i=1; while(the_repeater_field('commercial_gym_supply')): ?>
	<?php
	if( $i == 1 ){ echo '<div  class="col-lg-12 col-xs-12 col-sm-12 col-md-12 fitness_row_commercial">'; $closed = false; }
	?>
	<div class="col-lg-3 col-xs-12 col-sm-3 col-md-3 fitness<?php echo $i; ?>">
		<a href="<?php echo get_sub_field('page_link'); ?>"><img class="img-responsive" src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
		<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
			<?php 
				if(get_sub_field('commercial_product_category')):
					echo '<ul class="childfit">';
					$child = get_sub_field('commercial_product_category'); 
					foreach($child as $aterm):
						$term = get_term($aterm, 'product_cat'); 
						$alink = get_term_link($term);

						//echo '<li><a href="'.$alink.'">'.$term->name.'</a></li>';
						echo '<li>'.$term->name.'</li>';
					endforeach;
					echo '</ul>';
				endif;
			?>
	</div>
	<?php
	if( $i == 4 ){ echo "</div>"; $closed = true; }
	?>
<?php if($i==4): $i=1; else: $i++; endif; endwhile; ?>
<?php
if( !$closed ){ echo "</div>"; }
?>
	
</div>	
<?php endif; ?>

<?php endwhile; ?>

<div id="promises" class="col-lg-12 col-xs-12 col-sm-12 col-md-12 lower-promises">
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p>Best Price Promise | Call for our best deal</p>
	<span class="greendot first-greendot"></span>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p>Get expert advice on fitness equipment</p>
	<span class="greendot second-greendot"></span>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p class="last-child">Installation Service available UK wide</p>
	</div>
</div>



<?php get_footer(); ?>
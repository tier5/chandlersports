<?php
/**
* Template Name: Homepage
*/

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php if(get_field('slider') != NULL): ?>
	<div id="slides">
		<div class="slides_container">
			<?php while(the_repeater_field('slider')): ?>
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
						<?php if(get_sub_field('hire_link') != NULL): ?>
							<a href="<?php echo get_sub_field('hire_link'); ?>" class="hirenowlink"><?php echo get_sub_field('hire_text'); ?></a> 
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?> 

<div id="promises" class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
	<p>Best Price Promise | Call for our best deal</p>
	<span class="greendot"></span>
	<p>Get expert advice on fitness equipment</p>
	<span class="greendot"></span>
	<p class="last-child">Installation Service available UK wide</p>
</div>

<div id="kurt">
	<!--<img src="/wp-content/themes/chandler/images/kurt.png" />-->
	<!--<p id="greenarrow"><a href="/blog/">Chandler Sports Blog</a></p>-->
	
	<?php the_content(); ?>

	<!-- <h3>Welcome to Chandler Sports!</h3>
	<p class="kurtmap">Here you'll find a range of services, the latest products and all the information you need to help you find what you are looking for.</p> -->
	
	
	<br  style="clear: both;" />
	
</div>

<div id="homeproducts">
	<?php if(get_field('products') != NULL): ?>
		<?php $i=1; while(the_repeater_field('products')): ?>
			<div class="aproduct aproduct<?php echo $i; ?>">
				<a href="<?php echo get_sub_field('buy_link'); ?>"><img src="<?php echo get_sub_field('image'); ?>" border="0" /></a>
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
				
				<p><?php echo get_sub_field('kurt_says'); ?></p>
				
			</div>
		<?php $i++; endwhile; ?>
	<?php endif; ?>
</div>


 <div id="page">
    <div class="green-bg">	
	<h2 class="h2-home">Home fitness equipment</h2>
	<div id="home_fitness">
		<?php if(get_field('home_fitness_equipment') != NULL): ?>
			<?php $i=1; while(the_repeater_field('home_fitness_equipment')): ?>
				<div class="fitness<?php echo $i; ?>">
					<a href="<?php echo get_sub_field('page_link'); ?>"><img src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
					<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
						<?php 
							if(get_sub_field('home_product_categories')):
								echo '<ul class="childfit">';
								$child = get_sub_field('home_product_categories'); 
								foreach($child as $aterm):
									//$term = get_term($aterm, 'product_cat'); 
									$alink = get_term_link($aterm);
									
									echo '<li><a href="'.$alink.'">'.$aterm->name.'</a></li>';
								endforeach;
								echo '</ul>';
							endif;
						?>
				</div>
			<?php if($i==4): $i=1; else: $i++; endif; endwhile; ?>
		<?php endif; ?>
	</div>
    </div>	

	
	<?php if(get_field('commercial_fitness_image') != NULL): ?>
		<div id="commercial_banner" style="background-image: url(<?php echo get_field('commercial_fitness_image'); ?>);">
			<a href="http://www.chandlersports.co.uk/commercial-fitness-equipment-edinburgh/" style="width: 100%; height: 299px; display: block;"></a>
		</div>
	<?php endif; ?>
	
	<?php if(get_field('logo_list') != NULL): ?>
		<div id="commercial_people">
			<?php while(the_repeater_field('logo_list')): ?>
				<img src="<?php echo get_sub_field('logo'); ?>" alt="<?php echo get_sub_field('company_name'); ?>" border="0" />
			<?php endwhile; ?>
		</div>
	<?php endif; ?> 
	
	<h2 class="h2-commercial">Our fitness equipment services</h2> 
	<div id="commercial_services">
		<?php if(get_field('fitness_equipment_services') != NULL): ?>
			<?php $i=1; while(the_repeater_field('fitness_equipment_services')): ?>
				<div class="fes<?php echo $i; ?>">
					<a href="<?php echo get_sub_field('page_link'); ?>"><img src="<?php //echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
					<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
				</div>
			<?php $i++; endwhile; ?>
		<?php endif; ?>
	</div>

	
	
	 <h2 class="h2-commercial">Commercial gym supply - buy and hire</h2>
	<div id="commercial_supply">
		<?php if(get_field('commercial_gym_supply') != NULL): ?>
			<?php $i=1; while(the_repeater_field('commercial_gym_supply')): ?>
				<div class="supply<?php echo $i; ?>">
					<a href="<?php echo get_sub_field('page_link'); ?>"><img src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
					<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
				</div>
			<?php if($i==4): $i=1; else: $i++; endif; endwhile; ?>
		<?php endif; ?>
	</div> 


	<div id="SEO-text">

<?php echo the_field('seo_text_content'); ?>


</div>

</div>			

<?php endwhile; ?>

<?php get_footer(); ?>
<?php
/**
* Template Name: Commercial Fitness
*/

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="main_banner innerpage-image" style="background: transparent url('http://testweb4you.com/projects/chandlersports/wp-content/uploads/2016/04/in_bg.jpg') no-repeat scroll center center / cover;">
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
</div>
<div class="catg_main">
<div class="container">
<div class="row">
<div class="ab_box">
<div id="page" class="col-lg-12 col-xs-12 col-sm-12 col-md-12 no-padding">
	<?php if(get_field('logo_list') != NULL): ?>
	<!--	<div id="commercial_people">
			<?php while(the_repeater_field('logo_list')): ?>
				<img src="<?php echo get_sub_field('logo'); ?>" alt="<?php echo get_sub_field('company_name'); ?>" />
			<?php endwhile; ?>
		</div>-->
	<?php endif; ?>

<?php /*
<h2 class="h2-commercial">Commercial Fitness Equipment Services</h2>
<div id="commercial_services">
	<?php if(get_field('fitness_equipment_services') != NULL): ?>
		<?php $i=1; while(the_repeater_field('fitness_equipment_services')): ?>
			<div class="coms<?php echo $i; ?>">
				<a href="<?php echo get_sub_field('page_link'); ?>"><img src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" /></a>
				<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
			</div>
		<?php $i++; endwhile; ?>
	<?php endif; ?>
</div>
			*/ ?> 
<!--<span class="bhr-m"></span> -->

<?php if(get_field('commercial_gym_supply') != NULL): ?>
	<div class="commercial-fitness col-lg-12 col-xs-12 col-sm-12 col-md-12">		
			
			<?php $closed = true;  $i=1; while(the_repeater_field('commercial_gym_supply')): ?>
				<?php
				if( $i == 1 ){ echo '<div  class="col-sm-12 fitness_row_commercial">'; $closed = false; }
				?>
	<div class="col-lg-3 col-xs-12 col-sm-3 col-md-3 thm-image-hover  min-height-fitness fitness<?php echo $i; ?>">
				<div class="cat-products-new cf">
					
				<a href="<?php echo get_sub_field('page_link'); ?>"><img class="img-responsive images-width-height" src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
					
					<a href="<?php echo get_sub_field('page_link'); ?>"><h2 class="hvr-bounce-to-right"><?php echo get_sub_field('title'); ?></h2></a></h3>
					<?php
					if(get_sub_field('commercial_product_category')):
						echo '<ul class="childfit">';
						$child = get_sub_field('commercial_product_category');
						foreach($child as $aterm):
							$term = get_term($aterm, 'product_cat');
							$alink = get_term_link($aterm);
							echo '<li><a href="'.$alink.'">'.$aterm->name.'</a></li>';
						endforeach;
						echo '</ul>';
					endif;
					?>
					
				</div>	
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

<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 commercial-case-studies">
 <div class="col-sm-12">
	<h2 class="">Client Case Studies</h2>	
	<?php if(get_field('case_studies') != NULL): ?>
		<ul id="case-studies">
			<?php while(the_repeater_field('case_studies')): ?>
				<li><a href="<?php echo get_sub_field('page_link'); ?>" style="background-image: url(<?php echo get_sub_field('image'); ?>);"><?php echo get_sub_field('title'); ?></a></li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<div id="SEO-text">
	<?php echo the_field('seo_content_text'); ?>
	</div>
 </div>
</div>

</div>
</div>
</div>
</div>

</div>

<div class="srive_box">
	<div class="container">
    	<div class="sriv_tit">
        	<h1>Fitness Equipment Services</h1>
        </div>
        <div class="col-sm-2">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/gym-equipment-spare-parts-edinburgh/"><img src="../wp-content/themes/chandler/images/I1.jpg" alt="">
                <h2>Spare Parts</h2>
				</a>
            </div>
        </div>
        <div class="col-sm-2">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/commercial-gym-edinburgh/"><img src="../wp-content/themes/chandler/images/I2.jpg" alt="">
                <h2>Repairs</h2></a>
            </div>
        </div>
        <div class="col-sm-2">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/commercial-gym-edinburgh/cabling-services/"><img src="../wp-content/themes/chandler/images/I3.jpg" alt="">
                <h2>Cabling Service</h2></a>
            </div>
        </div>
        <div class="col-sm-2">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/commercial-gym-edinburgh/upholstery-repairs/"><img src="../wp-content/themes/chandler/images/I4.jpg" alt="">
                <h2>Upholstery</h2></a>
            </div>
        </div>
        <div class="col-sm-2">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/"><img src="../wp-content/themes/chandler/images/I5.jpg" alt="">
                <h2>Service &amp; Maintenance Contracts</h2></a>
            </div>
        </div>
        <div class="col-sm-2">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/delivery-installations-relocation/"><img src="../wp-content/themes/chandler/images/I6.jpg" alt="">
                <h2>Delivery,Installation &amp; Relocation </h2>
				</a>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>

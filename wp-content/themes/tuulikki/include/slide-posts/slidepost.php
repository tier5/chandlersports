<?php

	$tiposlide=get_field('select_slide_style','options');
	$ccclass="";
	$div1cclass="";
	$div2cclass="";
	$div3cclass="";
	$div4cclass="";
	$imgsize="";

	if(!get_field('slide_full', 'options')) {
		$ccclass="ig-container";
	}

	if($tiposlide == "1_post") {
		$div1cclass="cont_big_slidepost";
		$div2cclass="one-post-slider";
		$div3cclass="big_slidepost";
		$div4cclass="totalcover-1post";
		$imgsize="ig_image-1-post";
	} else if($tiposlide == "3_post") {
		$div1cclass="cont_big_slidepost";
		$div2cclass="big-post-slider";
		$div3cclass="big_slidepost";
		$div4cclass="totalcover-3postcentral";
		$imgsize="ig_image-3-post";
	} else if($tiposlide == "4_post") {
		$div1cclass="smallslick";
		$div2cclass="small-post-slider";
		$div3cclass="small_slidepost";
		$imgsize="ig_image-4-post";
	}

?>


<div class="<?php echo esc_attr($ccclass); ?>">
	<div class="slick <?php echo esc_attr($div1cclass); ?>">
		<div class="<?php echo esc_attr($div2cclass); ?> slider-top">

			<?php
				$selectpostmode=get_field('select_post_mode','options');

				if ($selectpostmode=="per_category") {
					$postxpage=get_field('number_post', 'options');
					$categories=get_field('categorys_post', 'options');

					$wp_query = new WP_Query( array(
						"posts_per_page" => $postxpage,
						"cat" =>  implode(",",$categories)
					));

				} else if($selectpostmode=="manual") {

					if (get_field('select_posts','option')) {
						$arrposts = array();
						while(has_sub_field('select_posts','option')) {
							$post_object = get_sub_field('select_the_posts');
							$id=$post_object->ID;
							array_push($arrposts,$id);
						}

						if(class_exists('WooCommerce')) {
							$tipopost = array('post', 'product');
						} else {
							$tipopost = array('post');
						}

						$args=array(
							'post__in' => $arrposts,
							'genre' => 'mystery',
							'post_type' => $tipopost,
							'paged' => 0,
							'posts_per_page' => -1
						);
						$temp = $wp_query;  // assign orginal query to temp variable for later use
						$wp_query = null;
						$wp_query = new WP_Query($args);
					} else {
						echo "<!-- no post selected -->";
					}
				}

				if (have_posts()) {
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						$thumb_slide_post = wp_get_attachment_image_src(get_post_thumbnail_id(), $imgsize);
						$url_slide = $thumb_slide_post["0"];
			?>


						<div class="<?php echo esc_attr($div3cclass); ?> ig-slide-margin">

							<?php if($tiposlide == "4_post") { ?>
								<img alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  src="<?php echo esc_url($url_slide); ?>">
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<div class="link_slide_center"></div>
								</a>
							<?php } else { ?>
								<div class="<?php echo esc_attr($div4cclass); ?>" style="background-image:url(<?php echo esc_url($url_slide); ?>);">
							<?php } ?>
									<div class="slidepost__desc">
										<div class="post__category slide_cat">
											<ul>
												<?php
													if (strtolower($post->post_type)=="product") {
														$categories = get_the_terms($post->ID, "product_cat");
														foreach ($categories as $category) {
															echo '<li><a href="'.esc_attr(get_term_link($category, 'cat')).'">'.$category->name.'</a></li>';
														}
													} else {
														$categories = get_the_category();
														foreach ($categories as $category) {
															echo '<li><a href="' . get_category_link($category->term_id) . '">'.$category->cat_name.'</a></li>';
														}
													}
												?>
											</ul>
										</div>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<time class="slide_date"><?php the_time( get_option('date_format') ); ?></time>
									</div><!-- .slidepost__desc-->

							<?php if($tiposlide == "4_post") { ?>
							<?php } else { ?>
								</div>	<!-- total cover -->
							<?php } ?>

						</div><!-- .big_slidepost-->
			<?php
					}
				} else {
					echo "<!-- no post found -->";
				}

				wp_reset_query();
				wp_reset_postdata();
			?>
		</div><!-- .slick-slider -->
	</div><!-- .slick -->

	<div class="clear"></div>

</div><!-- End ig-container -->


<script>
	function homePostgalleryInit() {

		<?php if($tiposlide == "1_post") { ?>

			jQuery('.one-post-slider').each( function() {
				var $one_carousel = jQuery(this);
				$one_carousel.on('init', function(slick) {
					$one_carousel.css("display","block");
				}).slick({
					dots: false,
					infinite: true,
					autoplay: false,
					speed: 600,
					slidesToShow: 1,
					slidesToScroll: 1
				});
				$one_carousel.slick('setPosition');
			});

		<?php } else if($tiposlide == "3_post") { ?>

			jQuery(".big-post-slider").each( function() {
				var $carousel = jQuery(this);
				$carousel.on('init', function(slick) {
					$carousel.css("display","block");
				}).slick( {
					dots: false,
					infinite: true,
					autoplay: false,
					speed: 600,
					slidesToShow: 3,
					centerMode: true,
					variableWidth: true,
				});
				$carousel.slick('setPosition');

				// Fade in each gallery like a boss
				jQuery(".slick").each( function() {
					jQuery(this).fadeTo( 200, 1 );
				});
				// Add next/prev navigation to the carousel
				jQuery('.slick-slider').on('click', '.slick-slide', function (e) {
					e.stopPropagation();
					var index = jQuery(this).data("slick-index");
					if (jQuery('.slick-slider').slick('slickCurrentSlide') !== index) {
						jQuery('.slick-slider').slick('slickGoTo', index);
					}
				});
				// Add classes to allow next/prev cursor styling
				$carousel.mousemove( function(e){
					var mouseXPosition = e.pageX - this.offsetLeft;
					if (mouseXPosition < jQuery( window ).width() / 2 ) {
						$carousel.removeClass( "right-arrow" );
						$carousel.addClass( "left-arrow" );
					} else {
						$carousel.removeClass( "left-arrow" );
						$carousel.addClass( "right-arrow" );
					}
				});
			});


		<?php } else if($tiposlide == "4_post") { ?>

			jQuery('.small-post-slider').each( function() {
				var $small_carousel = jQuery(this);
				$small_carousel.on('init', function(slick) {
					$small_carousel.css("display","block");
				}).slick({
					slidesToShow: 4,
					slidesToScroll: 4,
					dots: false,
					infinite: true,
					autoplay: false,
					speed: 900,
					responsive: [{
						breakpoint: 1024,
						settings: {
							speed: 900,
							slidesToShow: 3,
							slidesToScroll: 3,
							infinite: true,
							dots: false
						}
						},{
						breakpoint: 770,
						settings: {
							speed: 900,
							slidesToShow: 2,
							slidesToScroll: 2
							}
						},{
						breakpoint: 480,
						settings: {
							speed: 900,
							slidesToShow: 1,
							slidesToScroll: 1
							}
						}
				]});
				$small_carousel.slick('setPosition');
			});

		<?php } ?>
	}
</script>
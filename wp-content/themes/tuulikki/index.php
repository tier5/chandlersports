<?php
	/************************************************************************
	* Index
	*************************************************************************/
	get_header();

	$slideinclude="";

	/* == Slide Shortcode ==*/
    $shortcode_slide = get_field('slide_shortcode', 'options');
    echo do_shortcode( $shortcode_slide );
    
	/* == Slide Posts ==*/
	if(class_exists('acf') && get_field('activate_post_slider','options')) {
		echo "<div id='home-postgallery'></div>";
	}
	/* == Promo Box ==*/
	if(class_exists('acf') && get_field('activate_promotional_box-home','options')){
		include(TEMPLATEPATH."/include/promotional-box-home.php");
	}

	$mainclass="";

 	if (get_theme_mod('ig_sidebar_homepage') == true) {
 		$mainclass="main_content__full";
	} elseif(get_theme_mod('ig_home_layout') == 'full_grid') {
		$mainclass=" main_content__grid";
	} elseif(get_theme_mod('ig_home_layout') == 'grid') {
		$mainclass=" main_content__grid";
	} else {
		$mainclass="main_content__r";
	}

	$pagination=1;
	if(get_theme_mod('ig_infinite_scroll')) {
		$pagination=0;
	}



?>


<!-- Widget Welcome Text -->

<div class="ig-container">
	<div class="ig-cont-below-area">
		<?php  if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('below-slider-sidebar') ) ?>
	</div>
</div>


<div class="ig_wrapper">
	<div class="main_content">
		<div class="<?php echo $mainclass; ?>">
			<?php
				if (have_posts()) {
					$page = ilgelo_getpage();

					if(get_theme_mod("ig_home_layout") == "grid" || (get_theme_mod('ig_home_layout') == 'full_grid' && $page>1)) {
						echo "<ul id='main-content' class='ig-grid isotopeWrapper masonryContainer'>";
					} else if(get_theme_mod('ig_home_layout') == 'full_grid' && $page<=1) {
					} else {
						echo "<div id='main-content'>";
					}

					get_template_part("include/loop", "index");

					if(get_theme_mod("ig_home_layout") == "grid" || get_theme_mod("ig_home_layout") == "full_grid") {
						echo "</ul>";
					} else {
						echo "</div><!-- ".get_theme_mod("ig_archive_layout")."-->";
					}

					if($pagination==1) {
						ilgelo_pagination($wp_query->max_num_pages,"",$paged);
					} else {
						echo "<div style='clear:both'></div>";
						echo "<a href='#' title='Load more post' class='load-more read-more' id='btnLoadmore'>LOAD MORE POST</a>";
						echo "<div style='display:none' id='infinitescroll-wait'>";
						echo "	<center><i class='fa fa-refresh fa-spin'></i></center>";
						echo "</div>";
					}
				}
			?>
		</div><!--  .main_content__full - .main_content__r -->

		<?php if($pagination==0) { ?>

			<script type="text/javascript">
				jQuery(document).ready(function() {
				  jQuery('.masonryContainer').masonry();
				});

				var _pagbs = 1;
				jQuery("#btnLoadmore").click(function(event ) {
					event.preventDefault();
					_pagbs+=1;
					jQuery("#infinitescroll-wait").css("display","block");
					jQuery("#btnLoadmore").css("display","none");
					jQuery.ajax({
						url: "<?php echo site_url()?>/wp-admin/admin-ajax.php",
						type:"POST",
						data: "action=ilgelo_infinitescroll&page_no="+_pagbs,
						success: function(html){
							jQuery("#infinitescroll-wait").css("display","none");
							if (html.trim()!="" && html.indexOf("nomorepost")<0) {
								var el = jQuery(html);
								el.imagesLoaded(function () {
									if (jQuery('.isotopeItem_masonry').length>0) {
										jQuery('#main-content').masonry({itemSelector:'.isotopeItem_masonry'}).append(el).masonry('appended',el);
										jQuery("#btnLoadmore").css("display","block");
										el.find(".slide_gallery_post").each( function() {
											var $carousel = jQuery(this);
											$carousel.slick( {
												dots: false,
												infinite: true,
												autoplay: true,
												speed: 500,
												fade: true
											});
										});
									} else {
										jQuery('#main-content').append(el);
										el.find(".slide_gallery_post").each( function() {
											var $carousel = jQuery(this);
											$carousel.slick( {
												dots: false,
												infinite: true,
												autoplay: true,
												speed: 500,
												fade: true
											});
										});
										jQuery("#btnLoadmore").css("display","block");
									}
								});
							} else if (html.trim()!="" && html.indexOf("nomorepost")>0) {
								jQuery('#btnLoadmore').html("<?php _e('No more posts found', 'ilgelo'); ?>");
								jQuery("#btnLoadmore").css("display","block");
								jQuery("#btnLoadmore").addClass("disabled");
							}
						}
					});
				});
			</script>

		<?php } ?>

	</div><!--  .main_content -->

	<?php if(get_theme_mod('ig_sidebar_homepage')) : else : ?>
		<aside class="cont_sidebar sticky_sider">
			<?php get_sidebar(); ?>
		</aside><!--  .cont_sidebar -->
	<?php endif; ?>

</div><!--  .ig_wrapper -->

<?php if(class_exists('acf') && get_field('activate_post_slider','options')) { ?>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery.ajax({
			url: "<?php echo site_url()?>/wp-admin/admin-ajax.php",
			type:"POST",
			data: "action=ilgelo_postgallery",
			success: function(html){
				if (html.trim()!="") {
					var el = jQuery(html);
					el.imagesLoaded(function () {
						jQuery('#home-postgallery').css("opacity","0");
						jQuery('#home-postgallery').html(el);
						homePostgalleryInit();
						jQuery('#home-postgallery').fadeTo("slow" , 1, function() {});
					});
				}
			}
		});
	});
</script>

<?php } ?>


<?php get_footer(); ?>
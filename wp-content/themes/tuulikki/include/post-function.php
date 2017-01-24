<?php


/*================================
	RELATED POSTS
==================================*/


	function ilgelo_post_related() {
		global $post;
		global $ilgelo_options;
		$output="";
		$cclass="";

		$orig_post = $post;

		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach ($categories as $individual_category) {
				$category_ids[] = $individual_category->term_id;
			}
			$args=array(
					'category__in' => $category_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page'=> 3, // Number of related posts that will be shown.
					'ignore_sticky_posts' => 1,
					'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array( 'post-format-quote','post-format-link' ),
							'operator' => 'NOT IN'
						)
					)
			);

			$my_query = new wp_query($args);

			if($my_query->have_posts()) {
				echo "<div class='content-related-post post_container_sub_single'>";
				echo "	<h3 class='textaligncenter'>";
				echo __('RELATED POSTS','ilgelo');
				echo "</h3>";
				echo "	<ul>";

				while($my_query->have_posts()) {
					$my_query->the_post();

					$thumb_slide_post = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ig_related-post');
					$url_slide = $thumb_slide_post["0"];
					echo "	<li class='relatedPostItem textaligncenter'>";
					echo "<a href='".get_the_permalink()."'>";
					echo "	<img src='$url_slide'> ";
					echo "</a>";
					echo "	<div class='meta_related_post'>";
					echo "		<a href='".get_the_permalink()."'><h5>".get_the_title()."</h5></a>";
					echo "		<h6 class='r-p-date'>".get_the_date()."</h6>";
					echo "	</div>";
					echo "	</li>";
				}

				echo "	</ul>";
				echo "</div>";
			}

			$post = $orig_post;
			wp_reset_query();
		}
	}



/*================================
	AUTHOR
==================================*/


function ilgelo_post_author() {
$author_id = get_the_author_meta('ID');


$author_facebook_link = (class_exists('acf') && get_field('author_facebook_link', 'user_'. $author_id ));

$author_twitter_link = (class_exists('acf') && get_field('author_twitter_link', 'user_'. $author_id ));


$author_instagram_link = (class_exists('acf') &&get_field('author_instagram_link', 'user_'. $author_id ));

$author_pinterest_link = (class_exists('acf') && get_field('author_pinterest_link', 'user_'. $author_id ));

$author_google_link = (class_exists('acf') && get_field('author_google_link', 'user_'. $author_id ));


echo "<div class='post_container_sub_single'>";
echo "<div class='author-block'>";




	echo "<div class='title-header'>";


	echo "	<div class='author_avatar img-radius'>";
		 		echo get_avatar( get_the_author_meta('ID'), 100 );
	echo "	</div>";


	echo "	<div class='author_content'>";
	echo "		<p class='title_author'>";
					the_author();
	echo " 		</p>";

	echo "		<p class='desc_author'>";
					the_author_meta('description');
	echo " 		</p>";





echo "			<div class='post-footer'>";
echo "				<ul class='meta-share'>";
						if (!empty($author_facebook_link)) {
							echo "<li>";
							echo "<a target='_blank' href='$author_facebook_link'><i class='fa fa-facebook'></i></a> ";
							echo "</li>";
							}
						if (!empty($author_twitter_link)) {
							echo "<li>";
							echo "<a target='_blank' href='$author_twitter_link'> <i class='fa fa-twitter'></i></a> ";
							echo "</li>";
							}
						if (!empty($author_pinterest_link)) {
							echo "<li>";
							echo "<a target='_blank' href='$author_pinterest_link'> <i class='fa fa-pinterest'></i></a> ";
							echo "</li>";
							}
						if (!empty($author_google_link)) {
							echo "<li>";
							echo "<a target='_blank' href='$author_google_link'> <i class='fa fa-google'></i></a> ";
							echo "</li>";
							}

						if (!empty($author_instagram_link)) {
							echo "<li>";
							echo "<a target='_blank' href='$author_instagram_link'> <i class='fa fa-instagram'></i></a> ";
							echo "</li>";
							}
echo "				</ul>";
echo "			</div><!--  post-footer  -->";
echo "		</div>";

echo "</div>";





echo "</div>";
echo "</div>";



}
?>
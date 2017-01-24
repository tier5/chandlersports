<?php
	/*
	*
	*	about Widget
	*	------------------------------------------------
	*	Il Gelo about
	*
	*/
	// Register widget
	add_action( 'widgets_init', 'ilgelo_about' );
	function ilgelo_about() { return register_widget('ilgelo_about'); }

	class ilgelo_about extends WP_Widget {
		function __construct() {
			parent::__construct( 'ilgelo_about', $name = 'ILGELO About' );
		}

		function widget( $args, $instance ) {
			global $post;
			extract($args);

			// Widget Options
			$url 	 = $instance['url'];
			$image	 = $instance['image'];
			$text	 = $instance['text'];
			$title	 = $instance['title'];
			$subtitle	 = $instance['subtitle'];
			$facebook	 = $instance['url_facebook'];
			$twitter	 = $instance['url_twitter'];
			$pinterest = $instance['url_pinterest'];
			$instagram = $instance['url_instagram'];

			?>




<?php

echo "<div class='container-aboutme'>";

echo "	<img src='". $image ."'>";

echo "	<div class='cont-aboutme'>";

			if (!empty($title)) {
				if (!empty($url)) {
				echo "<a href=".$url."><p class='tit tithover'>".$title."</p></a>";
				}else{
				echo "<p class='tit'>".$title."</p>";
				}
			}

			if (!empty($subtitle)) {
			echo "<p class='subtit'>".$subtitle."</p>";
			}



echo "		<p class='desc'> " . $text . " </p>";

echo "<ul class='meta-share'>";


		if (!empty($facebook)) {
echo "	<li>";
echo "		<a target='_blank' href='" . $facebook . "'><i class='fa fa-facebook'></i></a>";
echo "	</li>";
		}

		if (!empty($twitter)) {
echo "	<li>";
echo "		<a target='_blank' href='" . $twitter . "'><i class='fa fa-twitter'></i></a> ";
echo "	</li>";
		}

		if (!empty($pinterest)) {
echo "	<li>";
echo "		<a target='_blank' href='" . $pinterest . "'><i class='fa fa-pinterest'></i></a>";
echo "	</li>";
		}

		if (!empty($instagram)) {
echo "	<li>";
echo "		<a target='_blank' href='" . $instagram . "'><i class='fa fa-instagram'></i></a>";
echo "	</li>";
		}


echo "</ul>";

echo "	</div><!-- End cont-aboutme -->";

echo "</div><!-- End img-cover -->";
?>









			<?php

		}

		/* Widget control update */
		function update( $new_instance, $old_instance ) {
			$instance    = $old_instance;

			$instance['url']  = strip_tags( $new_instance['url'] );
			$instance['image'] = strip_tags( $new_instance['image'] );
			$instance['text'] = strip_tags( $new_instance['text'] );
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
			$instance['url_facebook'] = strip_tags( $new_instance['url_facebook'] );
			$instance['url_twitter'] = strip_tags( $new_instance['url_twitter'] );
			$instance['url_pinterest'] = strip_tags( $new_instance['url_pinterest'] );
			$instance['url_instagram'] = strip_tags( $new_instance['url_instagram'] );




			return $instance;
		}

		/* Widget settings */
		function form( $instance ) {
			    // Set defaults if instance doesn't already exist
				// Defaults
				$url  = '';
				$image = '';
				$text = '';
				$title = '';
				$subtitle = '';
				$facebook = '';
				$twitter = '';
				$pinterest = '';
				$instagram = '';

			    if ( $instance ) {
					$url  = $instance['url'];
			        $image = $instance['image'];
			        $text = $instance['text'];
			        $title = $instance['title'];
			        $subtitle = $instance['subtitle'];
			        $facebook = $instance['url_facebook'];
			        $twitter = $instance['url_twitter'];
			        $pinterest = $instance['url_pinterest'];
			        $instagram = $instance['url_instagram'];
			    }

				// The widget form
				?>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'ilgelo'); ?></label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>




				<p>
					<label for="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>"><?php esc_html_e('Subtitle:', 'ilgelo'); ?></label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subtitle' )); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
				</p>




				<p>
					<label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php echo esc_html__( 'Link url:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_url($url); ?>"  class="widefat" />
				</p>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php echo esc_html__( 'Image url:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>"  class="widefat" />
				</p>



				<p>
					<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php echo esc_html__( 'Text:', 'ilgelo' ); ?></label><br>
					<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" type="<?php echo esc_attr($value['type']); ?>"><?php echo esc_attr($text); ?></textarea>
				</p>


				<p>
					<label for="<?php echo esc_attr($this->get_field_id('url_facebook')); ?>"><?php echo esc_html__( 'url facebook:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo esc_attr($this->get_field_id('url_facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('url_facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>"  class="widefat" />
				</p>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id('url_twitter')); ?>"><?php echo esc_html__( 'url twitter:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo esc_attr($this->get_field_id('url_twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('url_twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>"  class="widefat" />
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('url_pinterest')); ?>"><?php echo esc_html__( 'url pinterest:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo esc_attr($this->get_field_id('url_pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('url_pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>"  class="widefat" />
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('url_instagram')); ?>"><?php echo esc_html__( 'url instagram:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo esc_attr($this->get_field_id('url_instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('url_instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>"  class="widefat" />
				</p>



		<?php
		}

	}

?>
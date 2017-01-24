<?php

	/*
	*
	*	Banner Widget
	*	------------------------------------------------
	*	Il Gelo Banner
	*
	*/

	// Register widget
	add_action( 'widgets_init', 'ilgelo_banner' );
	function ilgelo_banner() { return register_widget('ilgelo_banner'); }

	class ilgelo_banner extends WP_Widget {
		function ilgelo_banner() {
			parent::__construct( 'ilgelo_banner', $name = 'ILGELO Advertising' );
		}

		function widget( $args, $instance ) {
			global $post;
			extract($args);

			// Widget Options
			$url 	 = $instance['url'];
			$image	 = $instance['image'];
			$title	 = $instance['title'];

			echo $before_widget;

			if (!empty($title)) {
				echo "<div class='tit_widget'>";
				echo "	<span>";
				echo "		".$title."";
				echo "	</span>";
				echo "</div>";		
			}
			?>
			
			
			
			

			<a class="ig_banner ig_bg_images" href="<?php echo $url ?>">
				  <img class="img_full_responsive" src="<?php echo $image ?>">
			</a>
			<?php

			echo $after_widget;
		}

		/* Widget control update */
		function update( $new_instance, $old_instance ) {
			$instance    = $old_instance;

			$instance['url']  = strip_tags( $new_instance['url'] );
			$instance['image'] = strip_tags( $new_instance['image'] );
			$instance['title'] = strip_tags( $new_instance['title'] );
			return $instance;
		}

		/* Widget settings */
		function form( $instance ) {

			    // Set defaults if instance doesn't already exist
			    if ( $instance ) {
					$url  = $instance['url'];
			        $image = $instance['image'];
			        $title = $instance['title'];
			    } else {
				    // Defaults
					$url  = '';
			        $image = '';
			        $title = '';
			    }

				// The widget form
				?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ilgelo'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('url'); ?>"><?php echo __( 'Link url:', 'ilgelo' ); ?></label>
					<input id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" class="widefat" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('image'); ?>"><?php echo __( 'Image url:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $image; ?>"  class="widefat"  />
				</p>
		<?php
		}

	}

?>
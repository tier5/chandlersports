<?php

	/*
	*
	*	Banner Widget
	*	------------------------------------------------
	*	Il Gelo Banner
	*
	*/

	// Register widget
	add_action( 'widgets_init', 'ilgelo_full_banner' );
	function ilgelo_full_banner() { return register_widget('ilgelo_full_banner'); }

	class ilgelo_full_banner extends WP_Widget {
		function ilgelo_full_banner() {
			parent::__construct( 'ilgelo_full_banner', $name = 'ILGELO Full Advertising' );
		}

		function widget( $args, $instance ) {
			global $post;
			extract($args);

			// Widget Options
			$url 	 = $instance['url'];
			$image	 = $instance['image'];

			echo $before_widget;

			
			?>
<div class="ig_full_banner">
			<a class="ig_banner ig_bg_images" href="<?php echo $url ?>">
				  <img class="img_full_responsive" src="<?php echo $image ?>">
			</a>
</div>
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
					<label for="<?php echo $this->get_field_id('url'); ?>"><?php echo __( 'Link url:', 'ilgelo' ); ?></label>
					<input id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" class="widefat" />
				</p>
				
				

				
				
				<p>
					<label for="<?php echo $this->get_field_id('image'); ?>"><?php echo __( 'Image url:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $image; ?>" class="widefat"  />
				</p>
				
				
				
				
				
				
				
		<?php
		}

	}

?>
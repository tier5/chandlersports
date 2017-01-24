<?php

	/*
	*
	*	Banner Widget
	*	------------------------------------------------
	*	Il Gelo Banner
	*
	*/

	// Register widget
	add_action( 'widgets_init', 'ilgelo_promobox' );
	function ilgelo_promobox() { return register_widget('ilgelo_promobox'); }

	class ilgelo_promobox extends WP_Widget {
		function ilgelo_promobox() {
			parent::__construct( 'ilgelo_promobox', $name = 'ILGELO Promo Box' );
		}

		function widget( $args, $instance ) {
			global $post;
			extract($args);

			// Widget Options
			$url 	 = $instance['url'];
			$image	 = $instance['image'];
			$title	 = $instance['title'];
			$text	 = $instance['text'];
			
			echo $before_widget;

			if (!empty($title)) {
				echo "<div class='tit_widget'>";
				echo "	<span>";
				echo "		".$title."";
				echo "	</span>";
				echo "</div>";		
			}
			?>
			
			
			
	<div class="widget_promo_box" style="background-image:url(<?php echo $image ?>)">
			
			
		<a href="<?php echo $url ?>">
			<div class="overlayBox">
				<div class="widget_promobox__desc">
					<h3><?php echo $text ?></h3>
				</div><!-- slidepost__desc -->
			</div><!-- End overlayBox -->
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
			$instance['text'] = strip_tags( $new_instance['text'] );
			return $instance;
		}

		/* Widget settings */
		function form( $instance ) {

			    // Set defaults if instance doesn't already exist
			    if ( $instance ) {
					$url  = $instance['url'];
			        $image = $instance['image'];
			        $title = $instance['title'];
			        $text = $instance['text'];
			        
			    } else {
				    // Defaults
					$url  = '';
			        $image = '';
			        $title = '';
			        $text = '';
			    }

				// The widget form
				?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ilgelo'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				
					<p>
					<label for="<?php echo $this->get_field_id('image'); ?>"><?php echo __( 'Image url:', 'ilgelo' ); ?></label><br>
					<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $image; ?>"  class="widefat"  />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e('Text:', 'ilgelo'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id('url'); ?>"><?php echo __( 'Link url:', 'ilgelo' ); ?></label>
					<input id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" class="widefat" />
				</p>
			
		<?php
		}

	}

?>
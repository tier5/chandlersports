<?php
	class ilgelo_wSocial extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'ilgelo clearfix', 'description' => __( 'Displays Social Icons in navigation bar!', 'ilgelo') );
			parent::__construct('lw_social', __('ILGELO Social', 'ilgelo'), $widget_ops);
			$this->alt_option_name = 'ilgelo';
		}

		// Creating widget front-end
		public function widget( $args, $instance ) {
			global $ilgelo_options;

			$title = apply_filters( 'widget_title', $instance['title'] );

			echo "<div class='ig_widget'>";
			if (!empty($title)) {
				echo "<div class='tit_widget'><span>";
				echo $title."<br>";
				echo "</span></div>";
			}
			echo "<div class='box_widget_social'>";
			
			
			
	echo "<div class='ig-top-social textaligncenter margin-15top'>";
			include(TEMPLATEPATH."/include/social-icons.php"); 
			echo "</div>";
			
			
		
			echo "</div>";
	        echo "<div class='tit_widget_bottom'></div>";
			echo "</div>";
			echo "<div class='clear'></div>";
		}

		// Widget Backend
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'New title', 'ilgelo' );
			}

			// Widget admin form
			?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ilgelo'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<?php
		}


		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
} // Class wpb_widget ends here


function wsocial_getecho($url_social, $icon_social) {
	$output = "";
	if ($url_social!="") {
		$output.="		<a href='".$url_social."' target='_blank'>\n";
		$output.="	<span class='symbol'>".$icon_social."</span>\n";
		$output.="		</a>\n";
	}
	return $output;
}


?>
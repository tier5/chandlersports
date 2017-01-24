<?php
add_action( 'customize_register', 'ilgelo_customize_register' );
function ilgelo_customize_register($wp_customize) {

	class Customize_Number_Control extends WP_Customize_Control {
		public $type = 'number';
	 
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			
		<?php if ($this->description!="") { ?>
<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
<?php } ?>			
			
			<input type="number" name="quantity" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width:70px;">
			</label>
			<?php
		}
	}
	
	class Customize_CustomCss_Control extends WP_Customize_Control {
		public $type = 'custom_css';
	 
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea style="width:100%; height:150px;" <?php $this->link(); ?>><?php echo $this->value(); ?></textarea>
			</label>
			<?php
		}
	}

}


?>
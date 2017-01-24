<?php 
/**
 * 
 * @file index.php The manin admin view file that will show the actual file manager
 * 
 * */

// Security check
if( !defined('ABSPATH') ) die();
?>

<?php
// Loading admin assets
$this->admin_assets();

?>

<?php require_once( 'header.php' ); ?>

<div class='fm-container'>
	
	<div class='col-main'>
		
		<div class='row'>
			
		<?php if( current_user_can('manage_options') ): ?>
		
			<!-- Loading file manager here -->
			<div id='file-manager'></div>
			
			<script>
				
				// This is necessary for elfiner file.
				PLUGINS_URL = '<?php echo plugins_url();?>';
				
				jQuery(document).ready(function(){
					jQuery('#file-manager').elfinder({
						url: ajaxurl,
						customData:{action: 'connector'}
					});
				});
				
			</script>
		
		<?php endif; ?>
			
		</div>
		
		<div class='row fm-data'>
			<?php require_once('utility.php'); ?>
		</div>
		
	</div>
	
	<?php require_once('sidebar.php'); ?>
	
</div>

<?php require_once('footer.php'); ?>

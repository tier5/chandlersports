<?php defined('ABSPATH') or die(); ?>

<?php
	
	// Settings processing
	if( isset( $_POST ) && !empty( $_POST ) ){
		
		$this->options->options['file_manager_settings'] = $_POST;
		
	}
	
	//~ $this->pr($this->options->options['file_manager_settings']);
	
	$admin_page_url = admin_url()."admin.php?page={$this->prefix}";
	
	if( !isset($_GET['sub_page']) || empty($_GET['sub_page']) ) $_GET['sub_page'] = 'files';
	// Escaping data
	$_GET['sub_page'] = preg_replace( "/[<>#$%]/", "", $_GET['sub_page']);
	// Sanitizing data
	$_GET['sub_page'] = filter_var($_GET['sub_page'], FILTER_SANITIZE_STRING);
	
	/**
	 * 
	 * array(
	 * 	'page_slug' => array('page_slug', 'page_path', 'name')
	 * )
	 * 
	 * */
	
	$admin_menu_pages = array(
		'files' => array( 'files', ABSPATH . 'wp-content' . DS . 'plugins' . DS . 'file-manager' . DS . 'views' . DS . 'admin' . DS . 'files.php', 'Files'),
	);
	
	$admin_menu_pages = apply_filters('fm_admin_menu_sub_pages', $admin_menu_pages);
	
	// Enqueing admin assets
	$this->admin_assets();
?>
<?php require_once( 'header.php' ); ?>
<div class='fm-container'>
	
	<div class='col-main'>
		
		<div class='row fmp-settings'>
			
			<h2>Settings</h2>
		
			<form action='' method='post' class='fmp-settings-form'>
				
					<table>
						<tr>
							<td><h4>URL and Path</h4></td>
							<td>
								<label for='show_url_path_id'> Show </label>
								<input type='radio' name='show_url_path' id='show_url_path_id' value='show' <?php  if( isset( $this->options->options['file_manager_settings']['show_url_path'] ) && !empty( $this->options->options['file_manager_settings']['show_url_path'] ) && $this->options->options['file_manager_settings']['show_url_path'] == 'show' ) echo 'checked'; ?>/>
								
								<label for='hide_url_path_id'> Hide </label>
								<input type='radio' name='show_url_path' id='hide_url_path_id' value='hide' <?php  if( isset( $this->options->options['file_manager_settings']['show_url_path'] ) && !empty( $this->options->options['file_manager_settings']['show_url_path'] ) && $this->options->options['file_manager_settings']['show_url_path'] == 'hide' ) echo 'checked'; ?>/>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type='submit' value='Save' />
							</td>
						</tr>
					</table>
					
			</form>
		
		</div>
		
		<div class='row fm-data'>
			<?php require_once('utility.php'); ?>
		</div>
		
	</div>
	
	<?php require_once('sidebar.php'); ?>
	
</div>

<?php require_once('footer.php'); ?>
<!--

-->

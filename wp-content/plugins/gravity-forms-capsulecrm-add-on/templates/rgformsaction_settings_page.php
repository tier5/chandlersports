<style type="text/css">
		.ul-square li { list-style: square!important; }
		.ol-decimal li { list-style: decimal!important; }
</style>
<div class="wrap">
	<?php
	if ($message && !empty($_POST)) {
		echo "<div class='fade below-h2 {$class}'>" . wpautop($message) . "</div>";
	}
	?>
	<form method="post" action="">
		<?php wp_nonce_field("update", "gf_capsulecrm_update") ?>
		<h2><?php _e("CapsuleCRM Account Information", "gravityformscapsulecrm") ?></h2>
		<p style="text-align: left;">
			<?php if (!$valid){?>
				If you don't have a CapsuleCRM account, you can 
				<a href='http://capsulecrm.com/?referrer=DCCNKG' target='_blank'>
					sign up for one here</a>
			<?php }?>
		</p>

		<table class="form-table">
			<tr>
				<th scope="row"><label for="gf_capsulecrm_url">CapsuleCRM account</label> </th>
				<td>
					<input type="text" size="75" id="gf_capsulecrm_url" name="gf_capsulecrm_url" value="<?php echo esc_attr($settings["url"]) ?>"/>
					<?php echo $validimage; ?>
					<br/> Your CapsuleCRM Account e.g. <b>yourcompany</b> for 
					http://<b>yourcompany</b>.capsulecrm.com
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="gf_capsulecrm_token">API Token</label> </th>
				<td>
					<input type="text" size="75" id="gf_capsulecrm_token" name="gf_capsulecrm_token" value="<?php echo esc_attr($settings["token"]) ?>"/>
						<?php echo $validimage; ?>
					<br/>Token can be found in CapsuleCRM under <b>Account</b>>
					<b>My Preferences</b>>
					<b>API Auth.Token</b>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="gf_capsulecrm_croned">Cron</label>
				</th>
				<td>
					<input type="checkbox" size="75" id="gf_capsulecrm_croned" name="gf_capsulecrm_croned" <?php echo $settings["cron"]?"checked":"" ?>/>
					<br/>Would you activate messages by cron? <a href="#cron">See
					below for explications.</a> <strong>If you don't know uncheck 
					this</strong>.
				</td>
			</tr>
			<tr>
				<td colspan="2" >
					<input type="submit" name="gf_capsulecrm_submit" class="button-primary" value="<?php _e("Save Settings", "gravityformscapsulecrm") ?>" />
				</td>
			</tr>

		</table>
		<div>

		</div>
	</form>

<?php if ($valid) { ?>
	<div class="hr-divider"></div>

	<h2>Usage Instructions</h2>

	<div class="delete-alert alert_gray">
		<h3>To integrate a form with CapsuleCRM:</h3>
		<ol class="ol-decimal">
			<li>
				Edit the form you would like to integrate (choose from the 
				<a href="<?php _e(admin_url('admin.php?page=gf_edit_forms')); ?>">
					Edit Forms page
				</a>).
			</li>
			<li>Click "Form Settings"</li>
			<li>Click the "Advanced" tab</li>
			<li><strong>Check the box "Enable CapsuleCRM integration"</strong></li>
			<li>Save the form</li>
		</ol>
	</div>

	<h3>Form Fields</h3>
	<p>
		Fields will be automatically mapped by CapsuleCRM using the default Gravity
		Forms labels. If you change the labels of your fields, make sure to use the
		following keywords in the label to match and send data to CapsuleCRM.
	</p>
	<div class="alert_yellow" style="margin-bottom:16px;">
		<p style="font-weight:normal; padding:10px;">
			Note: <strong>Form entries must have First &amp; Last Names</strong> 
			for data to be saved to CapsuleCRM.
		</p>
	</div>

	<ul class="ul-square">
		<li><code>Name</code></li>
		<li><code>Address</code></li>
		<li><code>Company</code></li>
		<li><code>Email</code></li>
		<li><code>Phone</code></li>
		<li>Anything not recognized by the list will be added to Notes</li>
	</ul>
	<p>
		If you need more specificity like create an opportunity or a task in the same
		time than a person or have custom fields. We can support you see contacts
		links.
	</p>
	
	<h3><a id="cron"></a>Cron</h3>
	<p>
		it is possible to delegate the sending in a crontab job. If you choose this
		option you should activated this by add this line :
	</p>
		<code>0 * * * * <?php echo __DIR__ . "/../api/send_queue.php" ?></code>
	<p>
		And give write access to the user web (often www-data) to this directory :
	</p>
		<code><?php echo __DIR__ . "/../api/queue/" ?></code></br>		
	<p>
		The result is the form is save in the directory and send to capsule at 
		regular intervals in this exemple, one by minute.<br/>
		The advantage is that the form don't take time after validation.
	</p>
	<form action="" method="post">
<?php wp_nonce_field("uninstall", "gf_capsulecrm_uninstall") ?>
<?php if (GFCommon::current_user_can_any("gravityforms_capsulecrm_uninstall")) { ?>
			<div class="hr-divider"></div>

			<h2>Uninstall CapsuleCRM Add-On</h3>
			<div class="delete-alert alert_red">
				<h3>Warning</h3>
				<p>This operation deletes ALL CapsuleCRM Feeds.</p>
				<?php
				$uninstall_button = '<input type="submit" name="uninstall" value="Uninstall CapsuleCRM Add-On" class="button" onclick="return confirm(\'Warning! ALL CapsuleCRM Feeds will be deleted. This cannot be undone. \'OK\' to delete, \'Cancel\' to stop", "gravityformscapsulecrm")\');"/>';
				echo apply_filters("gform_capsulecrm_uninstall_button", $uninstall_button);
				?>
			</div>
	<?php } ?>
	</form>
<?php } // end if($valid)  ?>
</div>
<script type="text/javascript">
	function update_capsulecrm_form(lead_id, model_id){
		console.log("update");

		var mysack = new sack("<?php echo admin_url("admin-ajax.php") ?>" );
		mysack.execute = 1;
		mysack.method = 'POST';
		mysack.setVar( "action", "wp_ajax_update_capsulecrm_form" );
		mysack.setVar( "wp_ajax_update_capsulecrm_form", "<?php echo wp_create_nonce("wp_ajax_update_capsulecrm_form") ?>" );
		mysack.setVar( "model_id", model_id);
		mysack.setVar( "lead_id", lead_id);
		mysack.encVar( "cookie", document.cookie, false );
		mysack.onError = function() { alert('<?php echo esc_js(__("Ajax error while setting lead property", "gravityforms")) ?>' )};
		mysack.runAJAX();

		return true;
	}
	function resend_capsulecrm_form(lead_id, model_id){
		var mysack = new sack("<?php echo admin_url("admin-ajax.php") ?>" );
		mysack.execute = 1;
		mysack.method = 'POST';
		mysack.setVar( "action", "wp_ajax_resend_capsulecrm_form" );
		mysack.setVar( "resend_capsulecrm_form", "<?php echo wp_create_nonce("resend_capsulecrm_form") ?>" );
		mysack.setVar( "lead_id", lead_id);
		mysack.setVar( "model_id", model_id);
		mysack.encVar( "cookie", document.cookie, false );
		mysack.onError = function() { alert('<?php echo esc_js(__("Ajax error while setting lead property", "gravityforms")) ?>' )};
		mysack.runAJAX();

		return true;
	}
</script>
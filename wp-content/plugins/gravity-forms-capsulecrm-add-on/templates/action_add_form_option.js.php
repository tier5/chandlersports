<style type="text/css">
	#gform_title .capsulecrm,
	#gform_enable_capsulecrm_label {
		float:right;
		background: url('<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); ?>../capsulecrm-icon.gif') right top no-repeat;
		height: 16px;
		width: 16px;
		cursor: help;
	}
	#gform_enable_capsulecrm_label {
		float: none;
		width: auto;
		background-position: left top;
		padding-left: 18px;
		cursor:default;
	}
</style>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#gform_settings_tab_2 .gforms_form_settings').append('<li><input type="checkbox" id="gform_enable_capsulecrm" /> <label for="gform_enable_capsulecrm" id="gform_enable_capsulecrm_label"><?php _e("Enable CapsuleCRM integration", "gravity-forms-capsulecrm") ?> <?php echo addslashes($tooltip); ?></label></li>');
		
		if($().prop) {
			$("#gform_enable_capsulecrm").prop("checked", form.enableCapsuleCRM ? true : false);
		} else {
			$("#gform_enable_capsulecrm").attr("checked", form.enableCapsuleCRM ? true : false);
		}
		
		$("#gform_enable_capsulecrm").live('click change load', function() {
			
			var checked = $(this).is(":checked")
			
			form.enableCapsuleCRM = checked;
			
			SortFields(); // Update the form object to include the new enableCapsuleCRM setting
			
			if(checked) {
				$("#gform_title").append('<span class="capsulecrm" title="<?php _e("CapsuleCRM integration is enabled.", "gravity-forms-capsulecrm") ?>"></span>');
			} else {
				$("#gform_title .capsulecrm").remove();
			}
		}).trigger('load');
		
		$('.tooltip_form_capsulecrm').qtip({
	         content: $('.tooltip_form_capsulecrm').attr('tooltip'), // Use the tooltip attribute of the element for the content
	         show: { delay: 200, solo: true },
	         hide: { when: 'mouseout', fixed: true, delay: 200, effect: 'fade' },
	         style: 'gformsstyle', // custom tooltip style
	         position: {
	      		corner: {
	         		target: 'topRight'
	                ,tooltip: 'bottomLeft'
	      		}
	  		 }
	      });
	});
</script>
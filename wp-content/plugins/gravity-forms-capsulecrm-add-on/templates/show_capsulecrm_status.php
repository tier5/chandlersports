<style type="text/css">
	td a.row-title span.capsulecrm_enabled {
		position: absolute;
		background: url('<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); ?>../capsulecrm-icon.gif') right top no-repeat;
		height: 16px;
		width: 16px;
		margin-left: 10px;
	}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('table tbody.user-list tr').each(function() {
			if(<?foreach($activeforms as $id){?>$('td.column-id', $(this)).text() == <?php echo $id; ?>||<?php }?>false) {
				$('td a.row-title', $(this)).append('<span class="capsulecrm_enabled" title="CapsuleCRM is Enabled for this Form"></span>');
			}
		});		
	});
</script>
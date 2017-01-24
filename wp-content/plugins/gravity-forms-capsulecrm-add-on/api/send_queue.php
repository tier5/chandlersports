<?php

ob_start();
define('WP_USE_THEMES', true);
require('../../../../wp-blog-header.php');
ob_end_clean();

require_once 'CapsuleCRMAPI.php';

$settings = get_option("gf_capsulecrm_settings");
$api =  new CapsuleCRMAPI($settings["url"], $settings["token"]);

$d = dir(__DIR__."/queue");

while (false !== ($entry = $d->read())) {
	if($entry=="." or $entry=="..")
		continue;
	$entry=__DIR__."/queue/".$entry;
	$data = unserialize(file_get_contents($entry));	
   $api->process($data['model'], $data['lead']);
	echo "send form:".$data['model']['id']." entry:".$data['lead']['id']."\n";
	unlink($entry);
}

$d->close();

?>

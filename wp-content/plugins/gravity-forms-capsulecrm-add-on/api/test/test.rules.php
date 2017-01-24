<?php
require_once '../CapsuleCRMAPIRules.php';
//require_once '../lib_compressed/Yaml.php';
 
var_dump(CapsuleCRMAPIRules::get()->getScopes());
 
$paths = array(
//	 array("person", "text"),
//	 array("person", "address", "country"),
//	 array("person", "opportunity", "text"),
//	 array("person", "address", "city"),
//	 array("person", "text"),
//	 array("person", "lastName"),
	 array("person", "history", "subject"),
	 array("person", "subject"),
	 );
 

$rules = CapsuleCRMAPIRules::get();
foreach($paths as $path){
	$res = $rules->transformPath($path);
	print_r($res);
}

exit;
$valuables = array(
	 "email",
	 "phone",
	 "website",
	 "test3",
	 "firstName",
	 "customField"
);
 

$rules = CapsuleCRMAPIRules::get();
foreach($valuables as $valuable){
	echo "The $valuable Field is".($rules->isValuable($valuable)?" ":" not ")."valuable";
	echo ($rules->isValuable($valuable)?" by ":" ").$rules->getValuable($valuable)."\n";
}




?>

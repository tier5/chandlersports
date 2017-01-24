<?php

require_once 'Data.php';
require_once "../CapsuleCRMAPI.php";

Data::get("data");
		  
$user = "dareton";
$token = "f7fe23e26661bb51f9173e86baf2844f";
$api = new CapsuleCRMAPI("dareton", "f7fe23e26661bb51f9173e86baf2844f");

list($model, $lead) = Data::get()->load(2);

//print_r(array("model"=>$model, "lead"=>$lead));

$api->process("create", $model, $lead);





<?php

function parse_template($template_name, $variables = array()) 
{
	extract($variables, EXTR_SKIP);
	ob_start();
	include (TEMPLATEPATH . '/templates/'.$template_name.'.php');
	return ob_get_clean();
}
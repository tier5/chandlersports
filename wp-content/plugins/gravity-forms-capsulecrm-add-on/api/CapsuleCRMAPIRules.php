<?php

/**
 * +-----------------------------------------------------------------------+
 * | Copyright (c) 2012, Nicolas de Marqué                                 |
 * | All rights reserved.                                                  |
 * |                                                                       |
 * | Redistribution and use in source and binary forms, with or without    |
 * | modification, are permitted provided that the following conditions    |
 * | are met:                                                              |
 * |                                                                       |
 * | o Redistributions of source code must retain the above copyright      |
 * |   notice, this list of conditions and the following disclaimer.       |
 * | o Redistributions in binary form must reproduce the above copyright   |
 * |   notice, this list of conditions and the following disclaimer in the |
 * |   documentation and/or other materials provided with the distribution.|
 * | o The names of the authors may not be used to endorse or promote      |
 * |   products derived from this software without specific prior written  |
 * |   permission.                                                         |
 * |                                                                       |
 * | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
 * | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     |
 * | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
 * | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
 * | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
 * | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
 * | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
 * | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
 * | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
 * | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
 * | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 * | Author: Nicolas de Marqué <nicolas@alinea.im>                         |
 * +-----------------------------------------------------------------------+
 *
 * PHP version 5
 *
 * @category  Wordpress Capsule Services
 * @author    Nicolas de Marqué <nicolas@alinea.im>
 * @copyright alinea ltd. 2012
 * @license   http://www.cecill.info/licences.fr.html The CeCILL License
 */

/**
 * Load rules
 * This class is a singleton
 */
class CapsuleCRMAPIRules {

	private $rules;
	private $primary = "person";
	private static $instance;
	private static $inc = 0; //Used for static functions
	private static $finded = 0; //Used for static functions
	private static $inc_history = 1000; //Used for static functions
	private static $search_fields;
	private $queue = array();
	private $transformations;
	private $parameters;
	private $parentable_entities;
	private $find_by;
	private $personnal_table;
	private $responses_entities;
	private $gf_transformations;
	private $capsule_parameters;
	private $entities_with_contacts;
	private $transformed_entities;

	/**
	 * Construct the object, load the rule's file
	 */
	private function __construct() {
		include "transformation_table.php";
		//include "system_table.php";
		$this->transformations = $transformation_table;
		$this->parameters = $default_parameters;
		$this->parentable_entities = $parentable_entities;
		$this->find_by = $default_find_by;
		$this->personnal_table = $personnal_table;
		$this->responses_entities = $responses_entities;
		$this->gf_transformations = $gf_transformations;
		$this->capsule_parameters = $capsule_parameters;
		$this->entities_with_contacts = $entities_with_contacts;
	}
	/**
	 * Get an static instance
	 * @return CapsuleCRMAPIRules
	 */
	static public function get() {
		if (self::$instance == null) self::$instance = new CapsuleCRMAPIRules();
		return self::$instance;
	}
	/**
	 * Take the form givens in the transformation_table file
	 * And integrate specifics value given for a form name
	 * @param type $form_title
	 */
	private function set_form($form_title) {
		$this->parameters = array_merge( $this->parameters, isset($this->personnal_table['forms'][$form_title]['parameters']) ? $this->personnal_table['forms'][$form_title]['parameters'] : array());
		$this->find_by = array_merge($this->find_by, isset($this->personnal_table['forms'][$form_title]['parameters']['find_by']) ? $this->personnal_table['forms'][$form_title]['parameters']['find_by'] : array());
		$this->rules = array_merge( $this->transformations, isset($this->personnal_table['forms'][$form_title]['fields']) ? $this->personnal_table['forms'][$form_title]['fields'] : array());
		$this->primary = $this->parameters['primary'];
		$this->transformed_entities = isset($this->parameters['transformed_entities']) ? $this->parameters['transformed_entities'] : array();
		$this->queue = isset($this->parameters['queue']) ? $this->parameters['queue'] : array($this->primary=>'update_or_create');
		if(!isset($this->queue['contacts']) && in_array($this->primary, $this->entities_with_contacts)){
			$this->queue['contacts']="update_or_create";
		}
	}
	/**
	 * Get all scope
	 * @return type
	 */
	static public function get_form($form_title) {
		$api_rules = self::get();
		$api_rules->set_form($form_title);
		return $api_rules;
	}
	/**
	 * Integrate the rules in a array of data
	 * @param array $collection all_data
	 * @param string $name the field name
	 * @param string_or_array $value the value of the field
	 */
	public function integrate(&$collection, $name, $value) {
		if (isset($this->rules[$name])) {
			$rules = $this->prepare($this->rules[$name]);
			foreach ($rules as $key=>$rule_value) {
				if (is_numeric($key)) {
					$path = $rule_value;
					$val = $value;
				} elseif (preg_match("/__toTransform__/", $rule_value)) {
					$path = $key;
					$val = "$rule_value:::$value";
					//self::$data[$name] = $value; //Todo rethink the data system
				} else {
					$path = $key;
					$val = $rule_value;
				}
				$paths = explode(">", $path);
				$collection = array_merge_recursive( $collection, self::uni_dimensional_array_to_multi($val, $paths));
			}
		//Add not recognize values to history
		} elseif(!isset($this->capsule_parameters[$this->primary][$name])) {
			$history_name = "history_".self::$inc_history;
			$collection[$history_name]['note'] = "$name: $value";
			$this->queue[$history_name] = 'create';
			$this->transformed_entities[$history_name] = "history";
			self::$inc_history++;
		}else{
			$collection[$this->primary][$name] = $value;
		}
		return $collection;
	}
	/**
	 * Prepare the rule
	 * @param type $rules
	 * @return type
	 */
	private function prepare($rules) {
		self::$inc++;
		$resulting_rules = array();
		foreach ($rules as $key=>$value) {
			$key = $this->transform_simple($key);
			$value = $this->transform_simple($value);
			$resulting_rules[$key] = $value;
		}
		return $resulting_rules;
	}
	/**
	 * Transform specifics rules
	 * @param string $string
	 * @return string
	 */
	private function transform_simple($string) {
		$regex = array(
			 "/_multiple/"=>"_" . self::$inc,
			 "/_primary/"=>$this->primary,
		);
		foreach ($regex as $pattern=>$replacement) {
			$string = preg_replace($pattern, $replacement, $string);
		}
		return $string;
	}
	/**
	 * Tranform dynamics rules to integrate values from others fields or make
	 * calculations
	 * @param array $field
	 * @param string $initial_key
	 */
	static private function transform_dynamics(&$field, $initial_key) {
		if (!is_array($field) && preg_match("/___toTransform___/", $field)) {
			$field = CapsuleCRMAPITransformDynamics::get()->parse($field, $initial_key);
		}
	}
	/**
	 * Make transformation after the integration
	 * @param array $collection
	 * @param array $data
	 */
	public function finalize(&$collection, $data) {
		capsule_log_debug("before", "rules_finalize");//capsule_log_debug($collection['contacts'], "rules_finalize");
		capsule_log_debug($collection, "rules_finalize");
		//exit
		CapsuleCRMAPITransformDynamics::get()->init($data);
		self::array_walk_recursive($collection, "remove_inc");
		self::array_walk_recursive($collection, "remove_empty");
		self::array_walk_recursive($collection, "concanete_streets");
		self::array_walk_recursive($collection, "transform_dynamics");
		//exit;
		capsule_log_debug($collection, "rules_finalize");
		capsule_log_debug("after", "rules_finalize");
	}
	//IMPORTANT: Without with function i loose my head in a cacophonie of errors.
	/**
	 * Transform a value in a array with keys provided by a array
	 * Example $a="string", $b=array("a", "b", "c"); give $a["a"]["b"]["c"] = "string";  
	 * @param mix $value
	 * @param array $positions
	 * @return array
	 */
	static public function uni_dimensional_array_to_multi($value, &$positions) {
		if (!empty($positions)) {
			$key = array_shift($positions);
			$t[$key] = self::uni_dimensional_array_to_multi($value, $positions);
		}else $t = $value;
		return $t;
	}
	/**
	 * Special array walk recursive with capabilities to work on the array inside 
	 * @param array $array
	 * @param string $callback
	 * @param string $class optionnal, if provided, the $callback should be static
	 */
	static public function array_walk_recursive(&$array, $callback, $class = "CapsuleCRMAPIRules") {
		foreach ($array as $key=>$value) {
			$class::$callback($value, $key);
			$array[$key] = $value;
			if (isset($array[$key]) && is_array($array[$key])) {
				$new_array = $array[$key];
				self::array_walk_recursive($new_array, $callback);
				$array[$key] = $new_array;
			}
		}
	}
	/**
	 * Remove empty fields
	 * @param mix $field
	 * @param string $initial_key
	 */
	static private function remove_empty(&$field, $initial_key) {
		$resulting_array = array();
		if (is_array($field)) {
			foreach ($field as $k=>$v) {
				if (!is_array($v) && ($v === "" or $v === null)) unset($field[$k]);
			}
		}
	}
	/**
	 * Remove inc created by transform simple
	 * @param mix $field
	 * @param string $initial_key
	 */
	static private function remove_inc(&$field, $initial_key) {
		$resulting_array = array();
		if (is_array($field)) {
			foreach ($field as $key=>$value) {
				if (preg_match("/_[0-9]+/", $key)) {
					$resulting_array[] = $value;
				} else {
					$resulting_array[$key] = $value;
				}
			}
			$field = $resulting_array;
		}
	}
	/**
	 * Concanete the streets
	 * @param mix $field
	 * @param string $initial_key
	 */
	static private function concanete_streets(&$field, $initial_key) {
		if (is_array($field) and $initial_key == "address") {
			$street="";
			if (isset($field['street1'])) {
				$streets.= $field['street1']." ";
				unset($field['street1']);
				$field['street'] = trim($streets);
			}
			if (isset($field['street2'])) {
				$streets.= $field['street2'];
				unset($field['street2']);
				$field['street'] = trim($streets);
			}
			if (isset($field['str_type'])) {
				$streets= $field['str_type'].": $streets";
				unset($field['str_type']);
				$field['street'] = trim($streets);
			}			
		}
	}
	/**
	 * Return the queue given by the transformation file
	 * @return type
	 */
	public function get_queue() {
		return $this->queue;
	}
	/**
	 * Return the find by with values provided
	 * actually just use for the entity person
	 * @param string $entity
	 * @param array $data
	 * @return array
	 * @throws Exception
	 */
	public function get_find_by($entity, $data) {
		self::$finded = 0;
		self::$search_fields = array_flip($this->find_by[$entity]);
		self::array_walk_recursive($data, "value_for_find_by");
		if (self::$finded != count(self::$search_fields)) {
			throw new Exception("The find could be use more field!!!\n ");
		}
		return self::$search_fields;
	}
	/**
	 * Take the find by and test on a particuliar branch of the $collection tree
	 * @param mix $field
	 * @param string $key
	 */
	private function value_for_find_by(&$field, $key) {
		if (isset(self::$search_fields[$key])) {
			self::$search_fields[$key] = $field;
			self::$finded++;
		}
	}
	/**
	 * Return the entities uses in responses (not same as on request ex: person=>party)
	 * @return array
	 */
	static private function get_responses_entities() {
		return self::get()->responses_entities;
	}
	static public function get_gf_transformation($type, $label) {
		if (isset(self::get()->gf_transformations[$type])){
			if (isset(self::get()->gf_transformations[$type][$label])) {
				return self::get()->gf_transformations[$type][$label];
			}
		}
		return $label;
	}
	/**
	 * Get the entity use in response
	 * @param string $entity
	 * @param string $domain
	 * @return string
	 */
	static public function get_response_entity($entity, $domain) {
		$responses_entities = self::get()->get_responses_entities();
		if (isset($responses_entities[$domain][$entity])){
			return $responses_entities[$domain][$entity];
		}
		return $entity;
	}
	/**
	 * Get the realname of an entity
	 * As a array couldn't have 2 key identical, a transformation is apply on 
	 * the entities before and after
	 * This array make the after transformation
	 * @param string $entity
	 * @return string
	 */
	static public function get_real_entity($entity) {
		//capsule_log_debug(self::get()->transformed_entities);
		if (isset(self::get()->transformed_entities[$entity])){
			return self::get()->transformed_entities[$entity];
		}
		return $entity;
	}
	/**
	 * 
	 * @param type $entity
	 * @return boolean
	 */
	static public function is_parentable($entity) {
		if (isset(self::get()->parentable_entities[$entity])) return true;
		return false;
	}
}

?>

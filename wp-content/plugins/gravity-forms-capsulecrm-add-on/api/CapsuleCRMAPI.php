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
 * The central class, which aggregate data call rules, transformations and 
 * send the result to capsule CRM.
 */
class CapsuleCRMAPI {

	private $api_user; // your capsulecrm url, e.g. http://yourcompany.capsulecrmhq.com
	private $api_token; // your capsulecrm api token; can be found under My Info
	private $last_entity = false;
	private $last_id = false;
	private $cron = false;
	private $queue;

	const CAPSULE_DEBUG = false;

	public function __construct($user, $token, $cron=false) {
		$this->api_user = $user;
		$this->api_token = $token;
		$this->person = '';
		$this->init_libraries();
		$this->capsule = new Services_Capsule($user, $token);
		$this->rules = CapsuleCRMAPIRules::get();
		$this->cron = $cron;
		$this->queue = __DIR__."/queue/";
	}
	/**
	 * Test Account and return result
	 * @return boolean
	 */
	public function test_account() {
		try {
			try {
				$response = $this->capsule->party->getAny(array('limit'=>1));
				if (is_object($response)) {
					return true;
				}
			} catch (Services_Capsule_UnexpectedValueException $ue) {
				if (self::CAPSULE_DEBUG) print_r($ue);
			}
		} catch (Services_Capsule_RuntimeException $re) {
			if (self::CAPSULE_DEBUG) print_r($re);
		}

		return false;
	}
	/**
	 * Save data to use later
	 * @param array $model
	 * @param array $lead
	 */
	private function save_data(&$model, &$lead){
		$data['model'] = $model;
		$data['lead'] = $lead;
		file_put_contents(
				$this->queue.$model["id"]."_".$lead['id'],
				serialize(array('model'=>$model, 'lead'=>$lead))
		);
	}
	/**
	 * Process the send of data from Wordpress to Capsule
	 * @param string $action
	 * @param array $model
	 * @param array $lead
	 */
	public function process($model, $lead) {
		try {
			try {
				try {
					try {
						try {
							try {
								try {
									try {
										//Save 
										if($this->cron){
											$this->save_data($model, $lead);
											return;
										}
										if (self::CAPSULE_DEBUG) $this->save_data($lead, $model);
										$data = $this->aggregate_post_data($model, $lead);
										$this->last_entity = false;
										$this->last_id = false;
										foreach ($this->rules->get_queue() as $entity=>$action) {
											if (isset($data[$entity])) {
												if ($entity == "contacts"){
													$this->process_contacts($action, $entity, $data[$entity]);
												}else{
													$this->commit($action, $entity, $data[$entity]);
												}
											}else {
												capsule_log_debug("l'entity $entity n'a pas de champs");
											}
										}
									} catch (HTTP_Request2_NotImplementedException $hre) {
										if (self::CAPSULE_DEBUG) print_r($hre);
									}
								} catch (HTTP_Request2_MessageException $hme) {
									if (self::CAPSULE_DEBUG) print_r($hme);
								}
							} catch (HTTP_Request2_LogicException $hle) {
								if (self::CAPSULE_DEBUG) print_r($hle);
							}
						} catch (HTTP_Request2_Exception $he) {
							if (self::CAPSULE_DEBUG) print_r($he);
						}
					} catch (HTTP_Request2_ConnectionException $hce) {
						if (self::CAPSULE_DEBUG) print_r($hce);
					}
				} catch (Services_Capsule_UnexpectedValueException $cuv) {
					if (self::CAPSULE_DEBUG) print_r($cuv);
				}
			} catch (Services_Capsule_RuntimeException $cre) {
				if (self::CAPSULE_DEBUG) print_r($cre);
			}
		} catch (Exception $e) {
			if (self::CAPSULE_DEBUG) print_r($e);
		}
	}
	/**
	 * Aggreagate data from gravityforms
	 * @param array $gfmodel
	 * @param array $values
	 * @return array
	 */
	private function aggregate_post_data($gfmodel, $values) {
		$gf_to_array = new GFToArray($gfmodel);
		$data = $gf_to_array->lead_to_array($values);
		$this->apply_rules($data, $gfmodel['title']);
		capsule_log_debug($data);
		return $data;
	}
	/**
	 * Apply rules on the data send by gravity form
	 * Replace 
	 * @param type $data
	 * @param type $form_title
	 */
	private function apply_rules(&$data, $form_title) {

		$collection = array();
		$rules = CapsuleCRMAPIRules::get_form($form_title);
		$this->rules = $rules;

		foreach ($data as $name=>$value) {
			$rules->integrate($collection, $name, $value);
		}
		$rules->finalize($collection, $data);
		$data = $collection;
	}
	/**
	 * Process the contacts independantly
	 * @param type string $action
	 * @param type string $entity
	 * @param type string $data
	 */
	private function process_contacts($action, $entity, $data) {
		$party = $this->get("party", $this->last_id);
		$party_contacts = array();
		$last_entity = $this->last_entity;

		if ($party->$last_entity->contacts !== "") foreach ((array) $party->$last_entity->contacts as $type=>$contacts) {
				if (is_array($contacts)) {
					foreach ($contacts as $contact) {
						$party_contacts[] = array($type=>(array) $contact);
					}
				}else $party_contacts[] = array($type=>(array) $contacts);
			}
		capsule_log_debug($party_contacts, "contacts");
		capsule_log_debug("commit contacts");
		foreach ($data as $contact) {
			$absent = true;
			$type = array_shift(array_keys($contact));
			foreach ($party_contacts as $party_contact) {
				$type_party = array_shift(array_keys($party_contact));
				if ($type_party != $type) continue;

				$c = $contact[$type];
				$p = $party_contact[$type];

				if (array() == (array_diff($c, $p))) {
					$absent = false;
					capsule_log_debug("$type are identicals", "contacts");

					break;
				}
			}
			if ($absent) {
				capsule_log_debug("$type are not identicals", "contacts");
				$this->update("contacts", $this->last_id, array("contacts"=>$contact));
			}else{
				capsule_log_debug("contact is present");
			}
		}
	}
	/**
	 * Get response size
	 * @param stdObject $response
	 * @param string $entity
	 * @param string $domain
	 * @return string
	 */
	private function get_response_size($response, $entity, $domain = "root_response") {
		$entity = CapsuleCRMAPIRules::get_response_entity($entity, $domain);
		$all = (array) $response;
		$root = (array) $all[$entity];
		return $root['@size'];
	}
	/**
	 * Get response id
	 * @param stdObject $response
	 * @param string $entity
	 * @return string or boolean
	 */
	private function get_response_id($response, $entity) {
		$entities = CapsuleCRMAPIRules::get_response_entity($entity, "root_response");
		$entity = CapsuleCRMAPIRules::get_response_entity($entity, "response");
		return isset($response->$entities->$entity->id) ? $response->$entities->$entity->id : false;
	}
	/**
	 * Commit each part present in the queue except the contacts
	 * @param string $action
	 * @param string $entity
	 * @param array $data
	 * @param string or number $id
	 */
	private function commit($action, $entity, $data, $id = false) {
		$real_entity = $entity;
		$entity = CapsuleCRMAPIRules::get_real_entity($entity);
		capsule_log_debug("commit $action - $real_entity => $entity with parent '$this->last_entity' id $id last_id '$this->last_id'");
		capsule_log_debug("data to commit : ", "data");
		capsule_log_debug($data, "data");
		switch ($action) {
			case "update_or_create":
				$parameters = $this->rules->get_find_by($entity, $data);
				list($size, $id, $identical) = $this->search($entity, $parameters, $data);
				if ($identical) {
					capsule_log_debug("not commit $entity is identical on the server with id $id (response size:$size) ");
					break;
				} else {
					capsule_log_debug("commit $entity is not identical on the server with id $id (response size:$size) ");
				}
				if (0 !== $size && false !== $id) {
					goto update; //$this->commit("update", $entity, $data, $id);
				} else {
					goto create; //$this->commit("create", $entity, $data);
				};
				break;
			case "create":
				create:
				$id = $this->create($entity, $data);
				//sleep(5);
				break;
			case "update":
				update:
				$this->update($entity, $id, $data);
				//sleep(5);
				break;
		}
		if (CapsuleCRMAPIRules::is_parentable($entity) && $id != null && $id != "") {
			capsule_log_debug("id `$id` $entity is parentable");
			$this->last_entity = $entity;
			$this->last_id = $id;
		} else {
			$this->last_real_entity = $entity;
			$this->last_real_id = $id;
		}
	}
	/**
	 * Control if a custom field is a boolean and if true remove the boolean
	 * parameter (presence can cause problem in the send process: recognition
	 * of the data)
	 * @param type $data
	 */
	private function controlIsBoolean(&$data) {
		if ("false" === $data["is_boolean"]) {
			unset($data["is_boolean"]);
			unset($data["boolean"]);
		}
		if (isset($data["is_boolean"])) {
			unset($data["is_boolean"]);
		}
	}
	/**
	 * Search if a part exists
	 * @param string $entity
	 * @param array $parameters
	 * @param array $data
	 * @return type
	 */
	private function search($entity, $parameters, $data) {
		$id = false;
		$identical = false;
		$size = 0;
		switch ($entity) {
			case "person":
			case "organisation":
				$response = $this->capsule->party->search(implode(" ", $parameters));
				$size = (int) $this->get_response_size($response, $entity, "root_response");
				$id = $this->get_response_id($response, $entity);
				return array($size, $id, false);
			case "customField":
				$last_entity = CapsuleCRMAPIRules::get_response_entity($this->last_entity, "search_child");
				if ($this->last_real_entity !== "customField") {
					if (method_exists($this->capsule->$last_entity->customField, "get")) {
						$this->response = $this->capsule->$last_entity->customField->get($this->last_id, "customfields");
					} else {
						$this->response = $this->capsule->$last_entity->customField->getAll($this->last_id);
					}
				}
				capsule_log_debug($this->response, "data_response");
				$response_vars = get_object_vars($this->response->customFields);
				$size = $response_vars["@size"];
				$values = ($size > 1) ? $this->response->customFields->customField : $this->response->customFields;

				$this->controlIsBoolean($data);
				capsule_log_debug($data, "data_response");

				foreach ($values as $key=>$value) {
					$value = (array) $value;
					if ($data['label'] == $value['label']) {
						$id = $value['id'];
						$identical = (array_intersect($data, $value) == $data);
						break;
					}
				}
				return array($size, $id, $identical);
		}
	}
	/**
	 * Get an entity
	 * @param string $entity
	 * @param string $id
	 * @return type
	 */
	private function get($entity, $id) {
		switch ($entity) {
			case "person":
			case "organisation":
			case "party":
				return $this->capsule->party->get($id);
		}
	}
	/**
	 * Create an entity
	 * @param string $entity
	 * @param array $data
	 * @return id
	 */
	private function create($entity, $data) {
		$last_entity = CapsuleCRMAPIRules::get_response_entity($this->last_entity, "create_child");
		capsule_log_debug("real create $entity $this->last_entity - $last_entity");
		if ($last_entity === false) {
			switch ($entity) {
				case "person": return $this->capsule->person->add($data);
				case "organisation": return $this->capsule->organization->add($data);
				case "case": return $this->capsule->kaze->add($data);
				case "opportunity": return $this->capsule->opportunity->add($data);
				case "task": return $this->capsule->task->add($data);
			}
		} else {
			switch ($entity) {
				case "person":
				case "organisation": return $this->capsule->$last_entity->party->add($this->last_id, $data);
				case "opportunity": return $this->capsule->$last_entity->opportunity->add($this->last_id, $data);
				case "case": return $this->capsule->$last_entity->kaze->add($this->last_id, $data);
				case "history": return $this->capsule->$last_entity->history->addNote($this->last_id, $data['note']);
				case "task": return $this->capsule->$last_entity->task->add($this->last_id, $data);
				case "tag": return $this->capsule->$last_entity->tag->add($this->last_id, $data);
				case "customField": return $this->capsule->$last_entity->customField->add($this->last_id, $data);
			}
		}
	}
	/**
	 * Update an entity
	 * @param string $entity
	 * @param string $id
	 * @param array $data
	 * @return void
	 */
	private function update($entity, $id, $data) {
		$last_entity = CapsuleCRMAPIRules::get_response_entity($this->last_entity, "create_child");
		capsule_log_debug("real update $entity $id $this->last_entity - $last_entity");
		if ($last_entity === false) {
			switch ($entity) {
				case "person": return $this->capsule->person->update($id, $data);
				case "organisation": return $this->capsule->organization->update($id, $data);
				case "case": return $this->capsule->kaze->update($id, $data);
				case "opportunity": return $this->capsule->opportunity->update($id, $data);
				case "task": return $this->capsule->task->update($id, $data);
			}
		} else {
			switch ($entity) {
				case "person":
				case "organisation": return $this->capsule->$last_entity->party->update($this->last_id, $id, $data);
				case "opportunity": return $this->capsule->$last_entity->opportunity->update($this->last_id, $data);
				case "case": return $this->capsule->$last_entity->cases->update($this->last_id, $id, $data);
				case "customField": $this->controlIsBoolean($data);
					return $this->capsule->$last_entity->customField->update($this->last_id, $id, $data);
				case "contacts": $last_entity = $this->last_entity;
					return $this->capsule->$last_entity->update($id, $data);
			}
		}
	}
	/**
	 * Initialize the libraries
	 */
	private function init_libraries() {
		$classes = array(
			 "PEAR_Exception"=>"/lib_compressed/PEARException.php",
			 "Request2"=>array(
				  "/lib_compressed/Request2.php",
				  "/lib_compressed/Request2Lib.php"
			 ),
			 "URL2"=>"/lib_compressed/URL2.php",
			 "Capsule"=>"/lib_compressed/Capsule.php",
				  //"Yaml"=>"/lib_compressed/Yaml.php",
		);
		foreach ($classes as $class=>$files) {
			if (!is_array($files)) $files = array($files);

			if (!class_exists($class)) {
				foreach ($files as $file) {
					try {
						require_once __DIR__ . "$file.notcompressed";
					} catch (Exception $exception) {
						//Nothing
					}
				}
			}
		}
		require_once __DIR__ . '/CapsuleCRMAPITransformDynamics.php';
		require_once __DIR__ . "/CapsuleCRMAPIRules.php";
		require_once __DIR__ . "/GFToArray.php";
	}
}

function ScanDirectory($Directory) {

	$MyDirectory = opendir($Directory) or die('Erreur');
	while ($Entry = @readdir($MyDirectory)) {
		if (is_dir($Directory . '/' . $Entry) && $Entry != '.' && $Entry != '..') {
			echo '<ul>' . $Directory;
			ScanDirectory($Directory . '/' . $Entry);
			echo '</ul>';
		} else {
			echo '<li>' . $Entry . '</li>';
		}
	}
	//closedir($MyDirectory);
}
function capsule_log_debug($log, $domain = "", $activ = true) {
	if(CapsuleCRMAPI::CAPSULE_DEBUG)return;
	ob_start();
	print_r($log);
	$log = ob_get_contents();
	ob_end_clean();
	$file = __DIR__ . "/log/debug_$domain." . date("Y.m.d");

	//ScanDirectory(__DIR__ . "");
	//echo "$file\n";
	if ($activ) $result = file_put_contents($file, " - $log\n", FILE_APPEND);
	chmod($file, 0777);
	//var_dump($result);
}
?>
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

class GFField{
	private $label;
	private $value;
	private $type;
	private $sub_label;
	/**
	 * @var CapsuleCRMAPIRules;
	 */
	private static $rules;
	function __construct($label, $value, $type, $sub_label=null){
		$this->label = $label;
		$this->value = $value;
		$this->type = $type;
		$this->sub_label = CapsuleCRMAPIRules::get()->get_gf_transformation($this->type, $sub_label);
	}
	public function __get($name){
		switch($name){
			case "label": return $this->getLabel();
			case "value": return $this->value;
			default: throw new Exception("Field not usable : $name");
		}
	}
	private function get_label(){
		if($this->is_concanetable())
			return $this->sub_label."_".$this->label;
		return $this->label;
	}
	private function is_concanetable(){
		if($this->type=="name")
			return true;
		return false;
	}
	private function is_parentable(){
		if($this->type=="address")
			return true;
		return false;
	}
	public function get_array(){
		if($this->value == "") return array();
		//if($this->sub_label == "Address Line 2") return array();
		if($this->is_parentable())
			return array($this->label=>array($this->sub_label=>$this->value));
		else				
			return array($this->get_label()=>$this->value);
	}
}

class GFToArray{

	/**
	 * Construct the transformation objects
	 * the model is record but data are just treat
	 * and it could be use many time without
	 * side effect
	 */
	public function __construct($model){
		$this->model = $model;		
	}
	/**
	 * Take a record and transform it in a array
	 */
	public function lead_to_array($lead){
		capsule_log_debug($lead, "form");
		$data = $this->aggregate_data($lead);
		capsule_log_debug($data, "form");
		return $data;
	}
	private function aggregate_data($data){
		foreach($data as $key=>$value){
			if(!is_numeric($key))continue;
			if(count(preg_split("/\./", $key))>1){
				list($id, $sid) = preg_split("/\./", $key);
			}  else {
				list($id, $sid) = array($key, null);
			}
			$field = self::get_field($id);
			$label = $field['adminLabel'] !== "" && $field['adminLabel'] !== null ?  $field['adminLabel'] : $field['label'];
			$type = $field["type"];
			$scope_name = $this->get_scope($id, $sid, $field);
			try{
				if(isset($field[$scope_name])&&is_array($field[$scope_name]))
				$sub_label = $this->get_label_in_scope($key, $scope_name, $field[$scope_name], $sid);
			}catch(Exception $e){
				$sub_label = null;
			}
			$fields[] = new GFField($label, $value, $type, $sub_label);			
		}
		$res = array();
		foreach($fields as $f){
			$res = array_merge_recursive($res, $f->get_array());
		}
		return($res);
	}
	private function get_field($id){
		foreach($this->model['fields'] as $field)
			if($field['id']==$id)
				return $field;
	}
	private function get_scope($id, $sid, $field){
		if($sid==null) return;
		switch($field['type']){
			case "name":
			case "address": return 'inputs';
			case "checkbox":
			case "radio": return 'choices';
			default:	return null;
		}
	}
	private function get_label_in_scope($id, $scope_name, $scope, $sid){
		switch($scope_name){
			case "inputs":
				foreach($scope as $item)
					if($item["id"]==$id){
						if($item['label']=="street"){
							return ($sid===1)?"street1":"street2";
						}						
						return $item['label'];
					}
			default: return false;
		}		
	}	
	
	
	####################################################################################################	

	private function debug_data($values){
		$key_to_remove = array("id", "form_id", "date_created", "is_starred", "is_read", "ip", "source_url", "post_id", "currency", "payment_status", "payment_date", "transaction_id", "payment_amount", "is_fulfilled", "created_by", "transaction_type", "user_agent");
		//capsule_log_debug($values, "form_before_treatment");
		foreach($key_to_remove as $key)unset($values[$key]);
		//capsule_log_debug(array_flip($key_to_remove), "form_before_treatment");
		capsule_log_debug($values, "form_before_treatment");
	}
	
	private function debug_model($model){
//		return
		
		//Display the field list
		$a="\$list_field_names = array(";foreach($model['fields'] as $id=>$field)$a .= "'".($field['label'])."'=>'".$id."',"; capsule_log_debug("$a);", "form_before_treatment");capsule_log_debug("$a);", "form_treatment");
		
		$list_form = array("id", "button", "title", "description", "labelPlacement", "top_label", "maxEntriesMessage", "confirmation", "useCurrentUserAsAuthor","cssClass","enableHoneypot","enableAnimation","postContentTemplateEnabled","postTitleTemplateEnabled","postTitleTemplate","postContentTemplate","lastPageButton","pagination","firstPageCssClass","limitEntries","limitEntriesCount","limitEntriesMessage","scheduleForm","scheduleStart","scheduleStartHour","scheduleStartMinute","scheduleStartAmpm","scheduleEnd","scheduleEndHour","scheduleEndMinute","scheduleEndAmpm","scheduleMessage","notification","fields", "enableCapsuleCRM", "postAuthor", "postCategory", "postStatus");
		$list_fields = array( "adminLabel","adminOnly","allowsPrepopulate","defaultValue","description","content","cssClass","errorMessage","id","inputName","isRequired","label","noDuplicates","size","type","postCustomFieldName","displayAllCategories","displayCaption","displayDescription","displayTitle","inputType","rangeMin","rangeMax","calendarIconType","calendarIconUrl","dateType","dateFormat","phoneFormat","addressType","defaultCountry","defaultProvince","defaultState","hideAddress2","hideCountry","hideState","inputs","nameFormat","allowedExtensions","captchaType","page_number","captchaTheme","simpleCaptchaSize","simpleCaptchaFontColor","simpleCaptchaBackgroundColor","failed_validation","productField","enablePasswordInput","maxLength","enablePrice","basePrice","disableQuantity","formId","pageNumber", "choices", "customFieldTemplate", "customFieldTemplateEnabled", "enableChoiceValue");		
		$to_save_form = array("id", "title", "description", "enableCapsuleCRM");		
		$to_save_form = array();		
		$to_save_field = array("adminLabel","defaultValue","description","content","id","inputName","label","size","type","inputType","nameFormat","failed_validation","formId");
		$to_save_field = array("adminLabel","id","label","type", "fields", "choices");
		$to_save_field = array("id","type", "fields", "choices");
		//$to_save_field = array();

		
		$field_names = array();
		
		//All
		$list_field_names = array('Input'=>'0','textarea'=>'1','dropdown'=>'2','Number'=>'3','drop down'=>'4','radio'=>'5','Hidden Field'=>'6','Name'=>'7','Date'=>'8','Time'=>'9','Phone'=>'10','Address'=>'11','Website'=>'12','Email'=>'13','File'=>'14','Post Custom Field'=>'15','Post Excerpt'=>'16','Product Name'=>'17','Quantity'=>'18','Option'=>'19','Shipping'=>'20','Donation'=>'21','Total'=>'22','Post Category'=>'23','Post Image'=>'24','Post Tags'=>'25',);
		//Contact
		//$list_field_names = array('Session Information'=>'0','Name'=>'1','Email'=>'2','Phone'=>'3','Subject'=>'4','Newsletter'=>'5',);
		$to_save_fieldname = array('Session Information'=>'0','Name'=>'1','Email'=>'2','Phone'=>'3','Subject'=>'4','Newsletter'=>'5',);

		$to_save_fieldname = array('radio'=>'5','Date'=>'8', 'Website'=>'12','Donation'=>'21');
		
		//$to_save_fieldname = array('Input'=>'0');		
		
		foreach($to_save_fieldname as $key)unset($field_names[$key]);foreach($list_field_names as $to_remove)unset($model['fields'][$fields]);
		
		$list_form = array_flip($list_form);
		$list_fields = array_flip($list_fields);		
		$to_save_form = array_flip($to_save_form);	
		$to_save_field = array_flip($to_save_field);
		
		$fields = $model['fields'];

		foreach($to_save_form as $to_remove=>$v)unset($list_form[$to_remove]);foreach($list_form as $to_remove=>$v)unset($model[$to_remove]);
		foreach($to_save_field as $to_remove=>$v)unset($list_fields[$to_remove]);foreach($list_fields as $to_remove=>$v)foreach($fields as $key=>$field)unset($fields[$key][$to_remove]);
		$rf=array();foreach($to_save_fieldname as $name=>$key){$t=$fields[$key];unset($fields[$key]);$rf[$name]=$t;}$fields=$rf;
		//capsule_log_debug($model, "form_before_treatment");
		capsule_log_debug($fields, "form_before_treatment");
		//exit;
	}
}

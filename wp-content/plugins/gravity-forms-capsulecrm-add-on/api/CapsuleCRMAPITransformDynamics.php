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
 * @category  Wordpress Services
 * @author    Nicolas de Marqué <nicolas@alinea.im>
 * @copyright alinea ltd. 2012
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   GIT: $Id$
 */

/**
 * The CapsuleCRMAPITransformDynamics class transform a string defined with
 * dynamics parameters in a readable string wich contain the values use in 
 * the form
 */
class CapsuleCRMAPITransformDynamics{
	/**
	 * the singleton instance
	 * @var CapsuleCRMAPITransformDynamics
	 */
	static $instance;
	/**
	 * A array of patterns use to replace the value send by form
	 * @var array
	 */
	private $patterns;
	/**
	 * A array of replacement, with an egal size than the patterns array
	 * @var array
	 */
	private $replaces;
	/**
	 * Use to verified that the object as receive data
	 * @var boolean 
	 */
	private $initialized;
	/**
	 * The charlist to protect in the transformations
	 * @var string
	 */
	private $charlist = "?{}[];!.+$*^-()";
	/**
	 * The constructor is private and must be call
	 * with the get method
	 */
	private function __construct(){
		$this->patterns = $this->replaces = array();
	}
	/**
	 * Prepare the data sending in the init method
	 * by add a pattern and a replacment for each value
	 * @param type $data
	 * @param type $parent_key
	 */
	private function prepare_data($data, $parent_key=""){		
		foreach($data as $key=>$value){
			if(is_array($value))
				$this->prepare_data($value, $key);
			elseif($parent_key!==""){
				$this->add_replacement($parent_key."_".$key, $value);
				$this->add_replacement($key, $value);
			}
			else
				$this->add_replacement("$key", $value);
		}
		
	}
	/**
	 * Add a replacements in the tables
	 * @param type $pattern
	 * @param type $replacement
	 */
	private function add_replacement($pattern, $replacement){
		$this->patterns[$pattern] = "/".addcslashes ( "{".$pattern."}", $this->charlist)."/";
		$this->replaces[$pattern] = $replacement;
	}
	/**
	 * Reinit the replacemennt for a specific patterns
	 * Actually just use to replace the value
	 * @param type $pattern
	 * @param type $replacement
	 */
	private function replace_replacement($pattern, $replacement){
		unset($this->patterns[$pattern]);
		unset($this->replaces[$pattern]);
		$this->add_replacement($pattern, $replacement);
	}
	/**
	 * Get the object
	 * @param array $data
	 * @return CapsuleCRMAPITransformDynamics
	 */
	static public function get(){
		if(self::$instance==null)
			self::$instance = new CapsuleCRMAPITransformDynamics();
		return self::$instance;
	}
	/**
	 * Init the transformations with sended data from form
	 * The initialization create the transformtion rules
	 * for provided values
	 * @param array $data
	 */
	public function init(array $data){
		$this->prepare_data($data);
		$this->initialized = true;
		//capsule_log_debug($this->patterns, "transformations");
		//capsule_log_debug($this->replaces, "transformations");
	}
	/**
	 * Take the data send by form and transform
	 * them in a string with integrated values
	 * The transformtion permit 
	 *  - to replace a predefined var enclose by {field_name} by its value
	 *  - to calcule an expression inside {% expression %}
	 *  - to defined a variable {variable_name=value}
	 * 
	 * @param array $data
	 * @return array
	 */
	public function parse($string, $key=""){
		$this->is_initialized();
		$this->defined_values = array();
		$result = $this->transform_to_string($string);		 
		//capsule_log_debug($this->patterns, "transformations");
		//capsule_log_debug($this->replaces, "transformations");
		capsule_log_debug("transformation $key from $string to $result", "transformations");
		return $result;
	}
	/**
	 * Verificate if the object is initialized
	 * Use in the parse method
	 * @throws Exception
	 */
	private function is_initialized() {
		if(false===$this->initialized)
			throw new Exception("Should be initialized before use");
	}
	/**
	 * Transform the string initialized by the parse method
	 * @param string $string
	 * @return string
	 */
	private function transform_to_string($string){
		list(,$rule,$value)=preg_split("/:::/", $string);
		//Simples transformations
		switch($rule){
			case"date": return date("Y-m-d", strtotime($value))."T00:00:00Z";
		}
		
		$this->replace_replacement("value", $value);	
		$string = $this->set_defined_vars($rule);
		$string = $this->provide_values($string);
		$string = $this->make_calculations($string);
		$string = $this->remove_empty($string);
		return $string;
	}
	/**
	 * Remove string not provided by the form
	 * @param type $string
	 * @return type
	 */
	private function remove_empty($string){
		return preg_replace("/\{[^\}]*\}/", "", $string);
	}
	/**
	 * Define the pattern for set a variable
	 * @param type $string
	 * @return type
	 */
	private function set_defined_vars($string){
		$fct = "realize_definition";
		$pattern = "/\{(([[:alpha:]]+[^\}]*)=([^\}]*))\}/"; //{var=value}
		return $this->make_transformations($string, $pattern, "definition");	
	}
	/**
	 * Defined the pattern for calculation
	 * @param type $string
	 * @return type
	 */
	private function make_calculations($string){
		$fct = "realize_calculation";
		$pattern = "/\{%(.*)%\}/";//{%calcul to realize%}
		return $this->make_transformations($string, $pattern, "calculation");	
	}
	/**
	 * Transform string with pattern send
	 * @param string $string
	 * @param type $pattern
	 * @param type $type
	 * @return type
	 */
	private function make_transformations($string, $pattern, $type){
		preg_match_all("$pattern", $string, $matches);
		$patterns = $replaces = array();
		for($i=0; $i<count($matches[0]); $i++){
			$patterns[] = "/".addcslashes($matches[0][$i], $this->charlist)."/";
			switch($type){
				case "calculation" : $replaces[]=$this->make_eval($matches[1][$i]); break;
				case "definition" : $replaces=""; $this->add_replacement($matches[2][$i], $matches[3][$i]); break;
			}
		}
		capsule_log_debug($patterns, "transformations");
		capsule_log_debug($replaces, "transformations");
		return preg_replace($patterns, $replaces, $string);
		
	}
	/**
	 * Eval a php transformation
	 * @param type $string
	 * @return type
	 */
	private function make_eval($string){
		capsule_log_debug("to eval $string", "transformations");
		try{
			return eval("return $string;");
		}catch(Exception $e){
			return "An error is present in $string";
		}
	}
	/**
	 * Provide values send by forms
	 * @param string $string
	 * @return string
	 */
	private function provide_values($string){
		return preg_replace($this->patterns, $this->replaces, $string);
	}

}
?>

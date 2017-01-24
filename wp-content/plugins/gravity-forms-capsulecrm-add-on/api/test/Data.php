<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data
 *
 * @author Nicolas
 */
class Data {

	static $instance;
	var $path;
	var $couples;

	private function __construct($path) {
		$this->path = $path;
		ob_start();
		include $path . "/couples.php";
		ob_end_clean();
		$this->couples = $couples;
	}
	/**
	 * 
	 * @param type $path
	 * @return Data
	 * @throws Exception
	 */
	static function get($path = null) {
		if (self::$instance == null) {
			if ($path == null)
				throw new Exception("Get once with path before get empty");
			self::$instance = new Data($path);
		}
		return self::$instance;
	}
	function load($model_id, $limit = 1) {
		$model = unserialize(file_get_contents(__DIR__ . "/" . $this->path . "/model." . $model_id));
		$leads = array();
		if ($limit == 0)
			$limit = count($this->couples);
		for ($i = 0; $i < count($this->couples); $i++) {
			$lead = unserialize(file_get_contents(__DIR__ . "/" . $this->path . "/lead." . $this->couples[$model_id][$i]));
			if ($limit == 1)
				return array($model, $lead);
			else
				$leads[] = $lead;
			if ($i >= $limit) {
				return array($model, $leads);
			}
		}
		return array($model, $leads);
	}
}

?>

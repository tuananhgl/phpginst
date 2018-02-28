<?php
	/**
	* 
	*/
	require_once('modules/sql.php');
	class baseModel
	{
		public $db;
		public function __construct() {
			$this->db = new DB();
		} 
	}
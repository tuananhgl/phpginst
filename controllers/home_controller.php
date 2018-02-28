<?php
	/**
	* 
	*/
	require_once('base_controller.php');
	class HomeController extends BaseController
	{
		function __construct() {
			parent::__construct();
			$this->folder = 'pages';
			$this->home = $this->load_model('home');
		}
		public function index() {
			$this->data['result'] = 'mvaq';
			$this->render('home',$this->data);	
		}		
		public function error()
		{
		    $this->render('error');
		}
	}
<?php
require_once('base_controller.php');
class PagesController extends BaseController
{
  function __construct()
  {
    parent::__construct();
    $this->folder = 'pages';
    $this->home = $this->load_model('home');
  }

  public function index()
  {
    $this->data['name'] = 'Tuấn Anh';
    $this->data['result'] = 'qưeqwe';
    $this->data['age'] = '22';
    $this->render('home', $this->data);
  }
  public function error()
  {
    $this->render('error');
  }
}
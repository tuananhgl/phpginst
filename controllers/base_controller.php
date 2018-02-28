<?php
  require_once('modules/sql.php');
  $files = [];
  $files[] = glob('models/*.php');
  $dirs = array_filter(glob('models/*'), 'is_dir');
  if(!empty($dirs)) {
    foreach ($dirs as $key => $fileOnDir) {
      $newDir = $fileOnDir.'/*.php';
      $files[] = glob($newDir);
    }
  }
  foreach ($files as $key => $dataFile) {
      foreach ($dataFile as $key => $fl) {
          include_once($fl);
      }
  }
  class BaseController
  {
      protected $folder; // Biến có giá trị là thư mục nào đó trong thư mục views, chứa các file view template của phần đang truy cập.
      protected $data = array();
      public $connectDb;
      public $id;
      public $idList;
      public $title;
      public $des;
      public $menuPage;
      function __construct() {
        $this->connectDb = new DB();
        $page404 = false;
        if($page404) {
          header('Location: index.php?controller=pages&action=error');
        }
        try {
          if(isset($_GET['id'])) {
            $this->data['id'] = $_GET['id'];
            $this->data['page'] = $this->connectDb->alone_data_where('data','id',$_GET['id']);
          }
          if(isset($_GET['idList'])) {
            $this->data['idList'] = $_GET['idList'];
            $this->data['page'] = $this->connectDb->alone_data_where('menu','id',$_GET['idList']);
          }
          if(isset($_GET['page'])) {
            if(!isset($_GET['action']) || $_GET['action'] != 'error'){
              $this->data['menuPage'] = $this->connectDb->alone_data_where('menu','file',$_GET['page']);
            }
          }else {
            if(isset($_GET['action']) && $_GET['action'] != 'error') {
              $menuPageFile = 'home';
              $this->data['menuPage'] = $this->connectDb->alone_data_where('menu','file',$menuPageFile);
            } else {
              $menuPageFile = '404';
              $this->data['menuPage'] = $this->connectDb->alone_data_where('menu','file',$menuPageFile);
            }
          }

          $this->data['listMenu'] = $this->connectDb->list_data_where_where('menu','menu_parent','0','hide','0');
        } catch (Exception $e) {
          header('Location: index.php?controller=pages&action=error');
        }
      }
      // Hàm check các thành phần của menuPage . ex: id, idList
      function check_all_data($table,$where='',$value='')

      // Hàm hiển thị kết quả ra cho người dùng.
      function render($file, $data = array())
      {
          // Kiểm tra file gọi đến có tồn tại hay không?
          $view_file = 'views/' . $this->folder . '/' . $file . '.php';
          if (is_file($view_file)) {
            // Nếu tồn tại file đó thì tạo ra các biến chứa giá trị truyền vào lúc gọi hàm
            extract($this->data);
            // Sau đó lưu giá trị trả về khi chạy file view template với các dữ liệu đó vào 1 biến chứ chưa hiển thị luôn ra trình duyệt
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            // Sau khi có kết quả đã được lưu vào biến $content, gọi ra template chung của hệ thống đế hiển thị ra cho người dùng
            require_once('views/layouts/application.php');
          } else {
            // Nếu file muốn gọi ra không tồn tại thì chuyển hướng đến trang báo lỗi.
            header('Location: index.php?controller=pages&action=error');
          }
      }
      function rsearch($folder, $pattern) {
          $dir = new RecursiveDirectoryIterator($folder);
          $ite = new RecursiveIteratorIterator($dir);
          $files = new RegexIterator($ite, $pattern, RegexIterator::GET_MATCH);
          $fileList = array();
          foreach($files as $file) {
              $fileList = array_merge($fileList, $file);
          }
          return $fileList;
      }
      function load_model($file) {
        $model_file = 'models/'.$this->folder.'/'.$file.'.php';
        if(is_file($model_file)) {
            require_once($model_file);
            $fileName = ucfirst($file);
            $className = $fileName;
            return new $className(); 
        }
      }
}
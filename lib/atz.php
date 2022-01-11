<?php ob_start(); session_start();?>
<?php 
	require_once("db.php");
	
	// Thông tin cấu hình do coder cài đặt
	require('config.php');

	include_once 'image.php';
?>
<?php


use Image\image;

class atz extends DB{

	public function __construct() {
		// Get url
		$this->site_url = $this->config_url();

		// Lấy thông tin thiết lập của web
		$this->get_site_setting();	

		$this->image = new image;
	}

	public function config_url(){
		
		// Đường dẫn tuyệt đối | Absolute path
		if($_SERVER['HTTP_HOST']=='localhost'){
			$web_url['root'] = $_SERVER['DOCUMENT_ROOT'].'/'.DOMAIN.'/';
		}else{
			$web_url['root'] = $_SERVER['DOCUMENT_ROOT'].'/';
		}
		
		if($_SERVER['HTTP_HOST']=='localhost'){
			$web_url['main'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST']."/".DOMAIN.'/';
		}else{
			$web_url['main'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].'/';
		}

		// Đường dẫn thư mục upload
		$web_url['upload'] = $web_url['main'].'upload/';

		// Đường dẫn trang admin
		$web_url['admin'] = $web_url['main'].'admin/';

		// Đường dẫn hiện tại
		$web_url['full'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$new_pageURL = explode( '?', $web_url['full'] );
		
		// Đường dẫn hiện tại (Không có chuỗi theo sau)
		$web_url['no_string'] = $new_pageURL[0];
		
		return $web_url;
	}

	
	// Kiểm tra quản trị đăng nhập
	function check_login(){
		if(!isset($_SESSION['user'])){
			header("location:login.php");
		}
	}

	// Kiểm tra khách hàng đăng nhập
	function check_login_customer(){
		if(!isset($_SESSION['customer'])){
			header("location:login.php");
		}
	}

	// Quản trị đăng xuất
	function logout(){
		if(isset($_GET['logout'])){
			if(isset($_SESSION['user']) && !empty($_SESSION['user'])){	
				unset($_SESSION['user']);
				header("location:login.php");
			}	
		}
	}

	// Khách hàng đăng xuất
	function logout_customer(){
		if(isset($_SESSION['customer']) && !empty($_SESSION['customer'])){	
			unset($_SESSION['customer']);
			header("location:index.php");
		}	
	}

	function get_site_setting(){
		if (!defined("SETTING")) {
		    $data = $this->select('setting',array('Setting_Lang'=>'vi'));
			define('SETTING', $data[0]);
		}
	}
}

?>
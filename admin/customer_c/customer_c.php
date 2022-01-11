<?php ob_start(); require_once('../lib/atz.php');?>
<?php 
class customer_controller extends atz{

	public function __construct() { 
		// parent::__construct();

		$this->check_login();
		
		$this->post = array(
			'Customer_Name'=>'',
			'Customer_MID'=>'',
			'Customer_Gender'=>'',
			'Customer_Birthday'=>'',
			'Customer_Email'=>'',
			'Customer_Mobile'=>'',
			'Customer_Address'=>'',
			'Customer_Created'=>'',
			'Customer_Updated' =>''
		);
	}

	public function get_customer(){
		$products = $this->select('customer');
		return $products;
	}

	function get_invoices(){
		$invoice = $this->select('invoice');
		return $invoice;
	}

	public function add_customer(){

		$post = $this->post;

		$errors = array();

		if(isset($_GET['edit'])){

			$customer  = $this->select('customer',array('Customer_ID'=>$_GET['edit']));
			
			if($customer){
				$customer = $customer[0];

				foreach ($customer as $k => $v) {
					if(isset($post[$k])){
						$post[$k] =$v;
					}
				}

				$this->post = $post;
			}
		}

		
		// Insert, Update
		if(!empty($_REQUEST) && isset($_REQUEST['submit'])){

			foreach ($_REQUEST as $k => $v) {
				if(isset($post[$k])){
					$post[$k] =$v;
				}
			}	

			if(!$post['Customer_Name']){
				$errors['Customer_Name'] = 'Chưa nhập tên';
			}
			if(!$post['Customer_MID']){
				$errors['Customer_MID'] = 'Chưa nhập dung lượng';
			}
			if(!$post['Customer_Gender']){
				$errors['Customer_Gender'] = 'Chưa nhập băng thông';
			}
			if(!$post['Customer_Birthday']){
				$errors['Customer_Birthday'] = 'Chưa nhập Email';
			}
			if(!$post['Customer_Email']){
				$errors['Customer_Email'] = 'Chưa nhập email';
			}
			if($post['Customer_Mobile']){
				$errors['Customer_Mobile'] = 'Chưa nhập số điện thoại';
			}

			
			if(empty($errors)){

				if (!isset($_REQUEST['edit'])) {

					// Insert
					$post['Hosting_Created'] = time();
					$rs = $this->insert('hosting', $post);

				}else{
					// Update
					$post['Hosting_Updated'] = time();
					$rs = $this->update('hosting', $post, array('Hosting_ID' => $_REQUEST['edit']));
				}
				
				if($rs==1){
					header("location:hosting_list.php");
				}

			}else{
				$rs = array('errors' => $errors);
				return $rs;	
			}
		}
	}

	// public function remove_customer(){

	// 	if(isset($_GET['delete'])){
	// 		$rs = $this->delete('hosting',array('Hosting_ID' => $_GET['delete']));
		
	// 		if($rs==1){
	// 			header("location:hosting_list.php");
	// 		}
	// 	}
	// }
	
}
?>
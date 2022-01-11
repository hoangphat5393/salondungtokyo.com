<?php ob_start(); require_once('../lib/atz.php');?>
<?php 
class template_controller extends atz{

	public function __construct() { 
		// parent::__construct();

		$this->check_login();
		
		$this->post = array(
			'Hosting_Name'=>'',
			'Hosting_Type'=>'',
			'Hosting_Capable'=>'',
			'Hosting_Bandwidth'=>'',
			'Hosting_Email'=>'',
			'Hosting_Ftp'=>'',
			'Hosting_MySql'=>'',
			'Hosting_SubDomain'=>'',
			'Hosting_Price' =>'',
			'Hosting_Show' => 1,
			'Hosting_Order'=> 1,
			'Hosting_Cat'=>''
		);
	}

	public function get_template(){
		$products = $this->select('template');
		return $products;
	}

	public function get_cat(){
		$cats = $this->select('cat',array('Cat_Type'=>'Hosting'));

		return $cats;
	}

	public function add_product(){


		$post = $this->post;

		$errors = array();

		if(isset($_GET['edit'])){

			$hosting  = $this->select('hosting',array('Hosting_ID'=>$_GET['edit']));
			
			if($hosting){
				$hosting = $hosting[0];

				foreach ($hosting as $k => $v) {
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

			$this->post = $post;

			if(!$post['Hosting_Name']){
				$errors['Hosting_Name'] = 'Chưa nhập tên';
			}
			if(!$post['Hosting_Capable']){
				$errors['Hosting_Capable'] = 'Chưa nhập dung lượng';
			}
			if(!$post['Hosting_Bandwidth']){
				$errors['Hosting_Bandwidth'] = 'Chưa nhập băng thông';
			}
			if(!$post['Hosting_Email']){
				$errors['Hosting_Email'] = 'Chưa nhập Email';
			}
			if(!$post['Hosting_Ftp']){
				$errors['Hosting_Ftp'] = 'Chưa nhập Ftp';
			}
			if(!$post['Hosting_MySql']){
				$errors['Hosting_MySql'] = 'Chưa nhập MySql';
			}
			if(!$post['Hosting_SubDomain']){
				$errors['Hosting_SubDomain'] = 'Chưa nhập Sub Domain';
			}
			if(!$post['Hosting_Cat']){
				$errors['Hosting_Cat'] = 'Chưa chọn chuyên mục';
			}
			if($post['Hosting_Price']==''){
				$errors['Hosting_Price'] = 'Chưa nhập giá';
			}elseif(!is_numeric($post['Hosting_Order'])){
				$errors['Hosting_Price'] = 'Chỉ được nhập số';
			}
			if($post['Hosting_Order']==''){
				$errors['Hosting_Order'] = 'Chưa nhập độ ưu tiên';
			}elseif(!is_numeric($post['Hosting_Order'])){
				$errors['Hosting_Order'] = 'Chỉ được nhập số';
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
				
				if(!empty($rs)){
					header("location:hosting_list.php");
				}

			}else{
				$rs = array('errors' => $errors);
				return $rs;	
			}
		}
	}

	public function remove_product(){

		if(isset($_GET['delete'])){
			$rs = $this->delete('hosting',array('Hosting_ID' => $_GET['delete']));
		
			if($rs==1){
				header("location:hosting_list.php");
			}
		}
	}
	
}
?>
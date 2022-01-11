<?php ob_start(); require_once('../lib/atz.php');?>
<?php 
class product_color_controller extends atz{

	public function __construct() { 
		parent::__construct();

		$this->check_login();

		$this->color_type = array(
			'1' => 'Cao Cấp',
			'2' => 'Đặc Biệt',
			'3' => 'Tiêu chuẩn'
		);

		$this->post = array(
			'Product_Color_Type'=>'',
			'Product_Color_Name'=>'',
			'Product_Color_Color1'=>'',
			'Product_Color_Color2'=>'',
			'Product_Color_Img'=>'',
			'Product_Color_Price'=> 0,
			'Product_Color_Priority'=> 1,
			'Product_Color_Show'=> 1,
			'Product_Color_Product'=>$_GET['id']
		);
	}

	public $thumb_width = 550;
	public $thumb_height = 400;
	
	// Ảnh nhỏ (500x706)
	// public $img_width = 500;
	// public $img_height = 706;

	// Ảnh vừa (1000x1411)
	public $img_width = 1000;
	public $img_height = 1411;

	// Ảnh lớn (1365x1926)
	// public $img_width = 1365;
	// public $img_height = 1926;

	public function get_product_color(){
		$product_colors = $this->select('product_color',array('Product_Color_Product'=>$_GET['id']),array('Product_Color_Priority'=>'DESC','Product_Color_ID'=>'ASC','Product_Color_Type'=>'ASC'));
		return $product_colors;
	}

	public function get_cat(){
		$cats = $this->select('cat',array('Cat_Type'=>'product_color'));
		return $cats;
	}

	public function get_current_data($id){

		$current_data = $this->select('product_color',array('Product_Color_ID'=>$id));
					
		if(!empty($current_data)){
			return $current_data[0];	
		}
		header('location:'.$this->site_url['admin'].'product_color_list.php');
	}

	public function add_product_color(){

		$post = $this->post;

		$errors = array();

		// Sửa - Lấy dữ liệu cũ 
		if(isset($_GET['edit'])){

			$current_data = $this->get_current_data($_GET['edit']);
			
			if($current_data){
				foreach ($current_data as $k => $v) {
					if(isset($current_data[$k])){
						$current_data[$k] =$v;
					}
				}
					
				$this->post = $current_data;
			}
		}
			
		// Thêm, Cập nhật dũ liệu
		if(!empty($_REQUEST) && isset($_REQUEST['submit'])){

			foreach ($_REQUEST as $k => $v) {
				if(isset($post[$k])){
					$post[$k] =$v;
				}
			}	

			$this->post = $post;
				
			if(!$post['Product_Color_Type']){
				$errors['Product_Color_Type'] = 'Chưa chọn phân loại';
			}
			if(!$post['Product_Color_Img'] && !$_FILES['Product_Color_Img']['tmp_name']){
				$errors['Product_Color_Img'] = 'Chưa chọn ảnh đại diện';	
			}else{
				if($_FILES['Product_Color_Img']['name']){
					// Kiểm tra file
					$check_file = $this->image->check_file($_FILES['Product_Color_Img']['name']);
					if ($check_file!=1) {
					    $errors['Product_Color_Img'] = $check_file;
					}	
				}	
			}
			if(!$post['Product_Color_Color1']){
				$errors['Product_Color_Color1'] = 'Chưa chọn màu chính';
			}
			if(!$post['Product_Color_Price']){
				$errors['Product_Color_Price'] = 'Chưa nhập giá';
			}
			if($post['Product_Color_Priority']==''){
				$errors['Product_Color_Priority'] = 'Chưa nhập độ ưu tiên';
			}elseif(!is_numeric($post['Product_Color_Priority'])){
				$errors['Product_Color_Priority'] = 'Chỉ được nhập số';
			}

			// Thứ mục ảnh
			$dir = '../upload/product_color/';

			if(!is_dir($dir)){
				mkdir($dir);
	        }
			
			// echo '<pre>';
			// print_r($post);
			// die;
				
			// Tiến hành insert, update
			if(empty($errors)){
					
			

				// Upload ảnh đại diện (thumbnail)
				if(isset($_FILES['Product_Color_Img']) && $_FILES['Product_Color_Img']['tmp_name']){
					$file = $_FILES['Product_Color_Img'];

					$ext = $this->image->file_type($file['name']);
		        }


				if (!isset($_REQUEST['edit'])) {

					// Tiến hành upload ảnh đại diện
					$thumb_name = time().'_'.rand(100000, 999999).'.'.$ext;

					if($this->image->upload($file['tmp_name'],$dir,$thumb_name,$this->thumb_width,$this->thumb_height)==1){
						$post['Product_Color_Img'] = $dir.$thumb_name;
					}
					
					// Insert
					$post['Product_Color_Created'] = time();

					$rs = $this->insert('product_color', $post);

				}else{
					
					// Xóa ảnh (thumbnail) trong trường hợp sửa
					$old_thumb = $current_data['Product_Color_Img'];
					
					if(isset($_FILES['Product_Color_Img']) && !empty($_FILES['Product_Color_Img']['tmp_name'])){
						
						$thumb_name = time().'_'.rand(100000, 999999).'.'.$ext;
							
						// Tiến hành upload ảnh đại diện
						if($this->image->upload($file['tmp_name'],$dir,$thumb_name,$this->thumb_width,$this->thumb_height)==1){
							$post['Product_Color_Img'] = $dir.$thumb_name;

							if(file_exists($old_thumb)){
								unlink($old_thumb);	
							}
						}
					}

					// Update
					$post['Product_Color_Updated'] = time();
					$rs = $this->update('product_color', $post, array('Product_Color_ID' => $_REQUEST['edit']));
				}
				
				if(!empty($rs)){
					header("location:product_color_list.php?id=".$_GET['id']);
				}

			}else{
				$rs = array('errors' => $errors);
				return $rs;	
			}
		}
	}


	// Xóa màu sản phẩm
	public function remove_product_color(){
		if(isset($_GET['delete'])){

			$dir = '../upload/product_color/';

			// Dữ liệu cần xóa
			$current_data = $this->get_current_data($_GET['delete']);


			// Xóa ảnh đại diện (thumbnail)
			$old_thumb = $current_data['Product_Color_Img'];
			
			// Tiến hành xoá ảnh đại diện nếu có	
			if(file_exists($old_thumb)){		
				unlink($old_thumb);
			}


			// Tiến hành xoá danh sách ảnh nếu có	
			$old_list_img = $current_data['Product_Color_Img'];
			if($old_list_img){
				$old_list_img = explode(PHP_EOL,$old_list_img);
				
				foreach ($old_list_img as $v) {	
					if(file_exists($dir.$v)){		
						unlink($dir.$v);
					}
				}
			}

			// Xóa dữ liệu trong database
			$rs = $this->delete('product_color',array('Product_Color_ID' => $_GET['delete']));
			if($rs==1){
				header("location:product_color_list.php?id=".$_GET['id']);
			}
		}
	}
	
}
?>
<?php require_once('lib/atz.php');?>
<?php 
class index_controller extends atz{

	public function __construct() {
		parent::__construct();
	}

	public function get_posts($post_id){
		$post = $this->select('post',array('Post_ID' => $post_id));

		// Kiểm tra có chuyên mục con hay không
		if(!empty($post)){
			$post = $post[0];
		}

		return $post;
	}

}
?>
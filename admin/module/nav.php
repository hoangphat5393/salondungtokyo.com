<?php require_once('nav_c.php');?>
<?php	
	$atz = new Module_nav_controller();

	$page = $atz->site_url['full'];
?>
<aside id="left-panel">

	<!-- User info -->
	<!-- <div class="login-info">
		<span>
			
			<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
				<img src="img/avatars/sunny.png" alt="me" class="online" /> 
				<span>
					john.doe 
				</span>
				<i class="fa fa-angle-down"></i>
			</a> 
			
		</span>
	</div> -->
	<!-- end user info -->

	<!-- NAVIGATION : This navigation is also responsive-->
	<nav>
		<!-- 
		NOTE: Notice the gaps after each icon usage <i></i>..
		Please note that these links work a bit different than
		traditional href="" links. See documentation for details.
		-->

		<ul>
			<li>
				<a href="<?=$atz->site_url['main'];?>" title="Trang chủ"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Web chính</span></a>
				<!-- <ul>
					<li>
						<a href="index.html" title="Dashboard"><span class="menu-item-parent">Analytics Dashboard</span></a>
					</li>
				</ul> -->	
			</li>

			<li class="<?=strpos($page,'contact_')?'active':''?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-phone"></i> <span class="menu-item-parent">Liên hệ</span></a>
				<ul>
					<li class="<?=strpos($page,'contact_list')?'active':''?>">
						<a href="contact_list.php">Danh sách liên hệ</a>
					</li>
				</ul>
			</li>
			
			<!-- <li class="<?=strpos($page,'cat_')?'active':''?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Chuyên mục</span></a>
				<ul>
					<li class="<?=strpos($page,'cat_add')?'active':''?>">
						<a href="cat_add.php">Thêm chuyên mục</a>
					</li>
					<li class="<?=strpos($page,'cat_list')?'active':''?>">
						<a href="cat_list.php">Danh sách chuyên mục</a>
					</li>
				</ul>
			</li> -->


			<!-- <li class="<?=strpos($page,'product_')?'active':''?>">
				<a href="#"><i class="fa fa-lg fa-fw fa fa-shopping-bag"></i> <span class="menu-item-parent">Sản phẩm</span></a>
				<ul>
					<li class="<?=strpos($page,'product_add')?'active':''?>">
						<a href="product_add.php">Thêm sản phẩm</a>
					</li>
					<li class="<?=strpos($page,'product_list')?'active':''?>">
						<a href="product_list.php">Danh sản phẩm</a>
					</li>
				</ul>
			</li> -->

			<li class="<?=strpos($page,'post_')?'active':''?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-copy"></i> <span class="menu-item-parent">Bài viết</span></a>
				<ul>
					<li class="<?=strpos($page,'post_add')?'active':''?>">
						<a href="post_add.php">Thêm bài viết</a>
					</li>
					<li class="<?=strpos($page,'post_list')?'active':''?>">
						<a href="post_list.php">Danh sách bài viết</a>
					</li>
				</ul>
			</li>

			<li class="<?=strpos($page,'slider_')?'active':''?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-clone"></i> <span class="menu-item-parent">Slides</span></a>
				<ul>
					<li class="<?=strpos($page,'slide_add')?'active':''?>">
						<a href="slide_add.php">Thêm slides</a>
					</li>
					<li class="<?=strpos($page,'slide_list')?'active':''?>">
						<a href="slide_list.php">Danh sách slides</a>
					</li>
				</ul>
			</li>

			<li class="<?=strpos($page,'setting_')?'active':''?>">
				<a href="#"><i class="fa fa-lg fa-cogs fa-fw"></i> <span class="menu-item-parent">Cài đặt</span></a>
				<ul>
					<li class="<?=strpos($page,'setting_')?'active':''?>">
						<a href="setting.php"> Cài đặt chung</span></a>
					</li>
				</ul>
			</li>
			
			
		</ul>
	</nav>
	

	<span class="minifyme" data-action="minifyMenu"> 
		<i class="fa fa-arrow-circle-left hit"></i> 
	</span>

</aside>
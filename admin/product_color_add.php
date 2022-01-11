<?php require_once('product_color_c/product_color_c.php');?>
<?php 
	
	$atz = new product_color_controller();

	$rs = $atz->add_product_color();
		
	$post = $atz->post;

	$color_type = $atz->color_type;
	
	$cats = $atz->get_cat();

	$errors = array();

	if(isset($rs['errors'])){
		$errors = $rs['errors'];	
	}
?>

<!DOCTYPE html>
<html lang="en-us">
	<head>
		<title> Thêm sản phẩm </title>
		
		<?php include('module/head.php')?>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">

	</head>
	
	<!-- #BODY -->
	<body class="">

		<!-- #HEADER -->
		<header id="header">
			<?php include('module/header.php')?>
		</header>
		<!-- END HEADER -->

		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<?php include('module/nav.php')?>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="index.php">Admin</a></li>
					<li>Chuyên mục</li>
					<li>Thêm sản phẩm</li>
				</ol>
				<!-- end breadcrumb -->

			</div>
			<!-- END RIBBON -->
			

			<!-- MAIN CONTENT -->
			<div id="content">

				<!-- row -->
				<div class="row">
					
					<!-- col -->
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">
							
							<!-- PAGE HEADER -->
							<i class="fa-fw fa fa-home"></i> 
								Admin 
							<span>>  
								Thêm sản phẩm
							</span>
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->
				
				<!--
					The ID "widget-grid" will start to initialize all widgets below 
					You do not need to use widgets if you dont want to. Simply remove 
					the <section></section> and you can use wells or panels instead 
					-->
				
					<!-- widget grid -->
					<section id="widget-grid" class="">

						<!-- row -->
						<div class="row">

							<!-- NEW WIDGET ROW START -->
							<div class="col-md-offset-2 col-sm-8">
						
								<!-- Widget ID (each widget will need unique ID)-->
								<div class="jarviswidget" id="wid-id-5" data-widget-colorbutton="false"	data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
									
									<header>
										<h2>Thêm màu</h2>
									</header>

									<!-- widget div-->

									<div>
										<!-- widget edit box -->
										<div class="jarviswidget-editbox">
											<!-- This area used as dropdown edit box -->
											<input class="form-control" type="text">
										</div>
										<!-- end widget edit box -->

										<!-- widget content -->
										<div class="widget-body">

											<form id="catForm" action="" method="post" enctype="multipart/form-data">

												<legend>Mời điền đầy đủ thông tin</legend>

												<fieldset>
													<div class="form-group <?=isset($errors['Product_Color_Type'])?'has-error':''?>">
														<label>Phân loại</label>
														<small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="INVALID" style=""><?=isset($errors['Product_Color_Type'])?$errors['Product_Color_Type']:''?></small>
														<select name="Product_Color_Type" id="Product_Color_Type" class="form-control">
															<?php foreach ($color_type as $k => $v): ?>
																<option value="<?=$k?>" <?php echo ($post['Product_Color_Type']==$k)?'selected':'' ?>><?=$v?></option>	
															<?php endforeach ?>
														</select>
													</div>
												</fieldset>

												<fieldset>
													<div class="form-group <?=isset($errors['Product_Color_Name'])?'has-error':''?>">
														<label for="Product_Color_Name">Tên màu</label>
														<small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="INVALID" style=""><?=isset($errors['Product_Color_Name'])?$errors['Product_Color_Name']:''?></small>
														<input type="text" class="form-control" id="Product_Color_Name" name="Product_Color_Name" value="<?=$post['Product_Color_Name']?>"/>
													</div>
													
													<div class="form-group <?=isset($errors['Product_Color_Img'])?'has-error':''?>">
														<label for="Product_Color_Img">Ảnh đại diện</label>
														<small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="INVALID" style=""><?=isset($errors['Product_Color_Img'])?$errors['Product_Color_Img']:''?></small>
														<?php if ($post['Product_Color_Img']): ?>
															<img src="<?=$post['Product_Color_Img']?>" alt="">
														<?php endif ?>
														<input type="file" class="form-control" id="Product_Color_Img" name="Product_Color_Img"/>
														<input type="hidden" class="form-control" name="Product_Color_Img" value="<?=$post['Product_Color_Img']?>" />
													</div>

													<div class="row">
														<div class="col-sm-6">
															<div class="form-group <?=isset($errors['Product_Color_Color1'])?'has-error':''?>">
																<label for="Product_Color_Price">Màu chính</label>
																<small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="INVALID" style=""><?=isset($errors['Product_Color_Color1'])?$errors['Product_Color_Color1']:''?></small>
																<input type="text" id="Product_Color_Color1" class="form-control" name="Product_Color_Color1" value="<?=$post['Product_Color_Color1']?>" placeholder="#ff0000">
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group <?=isset($errors['Product_Color_Color2'])?'has-error':''?>">
																<label for="Product_Color_Price">Màu phụ</label>
																<small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="INVALID" style=""><?=isset($errors['Product_Color_Color2'])?$errors['Product_Color_Color2']:''?></small>
																
																<input type="text" id="Product_Color_Color2" class="form-control" name="Product_Color_Color2" value="<?=$post['Product_Color_Color2']?>" placeholder="#ff0000">
															</div>
														</div>
													</div>

													<div class="form-group <?=isset($errors['Product_Color_Price'])?'has-error':''?>">
														<label for="Product_Color_Price">Giá</label>
														<small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="INVALID" style=""><?=isset($errors['Product_Color_Price'])?$errors['Product_Color_Price']:''?></small>
														<input type="text" id="Product_Color_Price" class="form-control" name="Product_Color_Price" value="<?=$post['Product_Color_Price']?>"/>
													</div>
						
													<div class="form-group <?=isset($errors['Product_Color_Show'])?'has-error':''?>">
														<label>Hiện</label>
														<small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="INVALID" style=""><?=isset($errors['Product_Color_Show'])?$errors['Product_Color_Show']:''?></small>
														<select name="Product_Color_Show" id="Product_Color_Show" class="form-control">
															<option value="0">Ẩn</option>
															<option value="1" <?=($post['Product_Color_Show']==1)?'selected':''?>>Hiện</option>
														</select>
														<i></i>
													</div>

													<div class="form-group">
														<label>Thứ tự</label>
														<input type="text" class="form-control" name="Product_Color_Priority" value="<?=$post['Product_Color_Priority']?>" />
													</div>
												</fieldset>

												<div class="form-actions">
													<button class="btn btn-default btn-lg" type="reset">
														<i class="fa fa-refresh"></i> Reset
													</button>
													<button class="btn btn-primary btn-lg" type="submit" name="submit">
														<i class="fa fa-save"></i> Lưu
													</button>
												</div>
												
											</form>

										</div>
										<!-- end widget content -->

									</div>
									<!-- end widget div -->

								</div>
								<!-- end widget -->

							
							</div>
							<!-- WIDGET ROW END -->

						</div>

						<!-- end row -->

					</section>
					<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->

		<!-- PAGE FOOTER -->
		<?php include('module/footer.php')?>
		<!-- END PAGE FOOTER -->

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<div id="shortcut">
			<ul>
				<li>
					<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
				<li>
					<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
				</li>
				<li>
					<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
				</li>
				<li>
					<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
				</li>
				<li>
					<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
				</li>
				<li>
					<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
				</li>
			</ul>
		</div>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->

		<!-- MAIN JS -->
		<?php include('module/js.php')?>

		<!-- PAGE RELATED PLUGIN(S)-->

		<script src="js/plugin/bootstrapvalidator/bootstrapValidator.min.js"></script>
		<!-- <script src="js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script> -->


		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
		<script src="js/plugin/summernote/summernote.min.js"></script>

		<script type="text/javascript">

			$(document).ready(function() {
				
				pageSetUp();

				/*
				 * COLOR PICKER
				 */
			
			    $('#Product_Color_Color1').colorpicker();
			    $('#Product_Color_Color2').colorpicker();

				// Kiểm tra url hợp lệ
				function isValidUrl(url) {
				    var myVariable = url;
				    if (/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(myVariable)) {
				        return 1;
				    } else {
				        return 0;
				    }
				}
			})
		
		</script>

	</body>

</html>
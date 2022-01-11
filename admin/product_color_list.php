<?php require_once('product_color_c/product_color_c.php');?>

<?php 
	$atz = new product_color_controller();
	$product_color_list = $atz->get_product_color();
	
	$color_type = $atz->color_type;

	$del_product = $atz->remove_product_color();
?>


<!DOCTYPE html>
<html lang="en-us">
	<head>
		<title> Danh sách sản phẩm </title>
		
		<?php include('module/head.php')?>

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
					<li>Admin</li>
					<li>Chuyên mục</li>
					<li>Danh sách sản phẩm</li>
				</ol>
				<!-- end breadcrumb -->

			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">
				<div class="row">
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">
							<i class="fa fa-table fa-fw "></i> 
								Admin 
							<span>> 
								Danh sách màu
							</span>
						</h1>
					</div>
				</div>

				<!-- widget grid -->
				<section id="widget-grid" class="">

					<!-- row -->
					<div class="row">

						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
								
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Danh sách màu</h2>
								</header>

								<!-- widget div-->
								<div>

									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
									</div>
									<!-- end widget edit box -->

									<!-- widget content -->
									<div class="widget-body">
										
										<a href="product_color_add.php?id=<?=$_GET['id']?>" class="btn btn-labeled btn-primary"> 
											<span class="btn-label"><i class="fa fa-plus-circle"></i></span>Thêm màu
										</a>
										<div class="table-responsive">
										
											<table class="table table-bordered table-striped table-hover vcenter">
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th>Phân loại</th>
														<th class="text-center">Màu</th>
														<th class="text-center">Giá</th>
														<th class="text-center">Hiện</th>
														<th class="text-center">Ưu tiên</th>
														<th class="text-center">Ngày đăng</th>
														<th class="text-center">Thao tác</th>
													</tr>
												</thead>
												<tbody>
													<?php if (!empty($product_color_list)): ?>
														<?php foreach ($product_color_list as $v):?>
															<tr>
																<td class="text-center"><?=$v['Product_Color_ID']?></td>
																<td>
																	<p><?=$color_type[$v['Product_Color_Type']]?></p>
																	<img src="<?=$v['Product_Color_Img']?>" alt="" class="img-responsive" width="150">
																</td>
																<td class="text-center">
																	<?=$v['Product_Color_Name']?>
																</td>
																<td class="text-center"><?=number_format($v['Product_Color_Price'],0,',','.')?>đ</td>
																
																<td class="text-center">
																	<?php if ($v['Product_Color_Show']): ?>
																		Hiện
																	<?php else: ?>
																		Ẩn
																	<?php endif ?>
																</td>
																<td class="text-center"><?=$v['Product_Color_Priority']?></td>
																<td class="text-center"><?=date('d-m-Y',$v['Product_Color_Created'])?></td>

																<td class="text-center">
																	<a class="btn btn-sm btn-primary" href="product_color_add.php?id=<?=$_GET['id']?>&edit=<?=$v['Product_Color_ID']?>"><i class="fa fa-pencil-square-o"></i></a>
																	<a class="btn btn-sm btn-danger" href="product_color_list.php?id=<?=$_GET['id']?>&delete=<?=$v['Product_Color_ID']?>"><i class="fa fa-times"></i></a>
																</td>
															</tr>	
														<?php endforeach ?>
													<?php else:?>
														<tr>
															<td colspan="8" class="text-center">Chưa có dữ liệu</td>
														</tr>	
													<?php endif ?>
													
												</tbody>
											</table>
											
										</div>
									</div>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->

							</div>
							<!-- end widget -->

						</article>
						<!-- WIDGET END -->

					</div>

					<!-- end row -->

					<!-- row -->

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

		<!-- PAGE RELATED PLUGIN(S) -->


		<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		$(document).ready(function() {
			pageSetUp();
		})

		</script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<?php //include('module/google_analytics.php')?>

	</body>

</html>
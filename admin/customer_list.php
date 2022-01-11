<?php require_once('customer_c/customer_c.php');?>

<?php 
	$customer_class = new customer_controller();
	$list_customers = $customer_class->get_customer();
	// $del_hostings = $customer_class->remove_product();
?>


<!DOCTYPE html>
<html lang="en-us">
	<head>
		<title> Danh sách hosting </title>
		
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
					<li>Danh sách hosting</li>
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
								Danh sách khách hàng
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
									<h2>Danh sách khách hàng</h2>
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
										
										<a href="hosting_add.php" class="btn btn-labeled btn-primary"> 
											<span class="btn-label"><i class="fa fa-plus-circle"></i></span>Thêm
										</a>
										<div class="table-responsive">
										
											<table class="table table-bordered table-striped table-hover vcenter">
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th>Tên khách hàng</th>
														<th class="text-center">MID</th>
														<th class="text-center">Ngày sinh</th>
														<th class="text-center">Liên hệ</th>
													
														<th class="text-center">Địa chỉ</th>
														<th class="text-center">Ngày đăng ký</th>
														<th class="text-center">Cập nhật cuối</th>
														<th class="text-center">Thao tác</th>
													</tr>
												</thead>
												<tbody>
													<?php if (!empty($list_customers)): ?>
														<?php foreach ($list_customers as $v):?>
															<tr>
																<td class="text-center"><?=$v['Customer_ID']?></td>
																<td><?=$v['Customer_Name']?></td>
																<td class="text-center"><?=$v['Customer_MID']?></td>
																<td class="text-center"><?=$v['Customer_Birthday']?></td>
																<td class="">
																	<a href="mailto:<?=$v['Customer_Email']?>" title="Email"><i class="fa fa-fw fa-envelope"></i> <?=$v['Customer_Email']?></a><br>
																	<a href="tel:<?=$v['Customer_Mobile']?>" title="Phone"><i class="fa fa-fw fa-phone"></i> <?=$v['Customer_Mobile']?></a><br>
																	<a href="#" title="Địa chỉ"><i class="fa fa-fw fa-map-pin"></i> <?=$v['Customer_Address']?></a>
																</td>
																<td class="text-center"><?=$v['Customer_Address']?></td>
																
																
																<td class="text-right"><?=date('Y-m-d',$v['Customer_Created'])?></td>
																<td class="text-right"><?=date('Y-m-d',$v['Customer_Updated'])?></td>
																
																<td class="text-center">
																	<a class="btn btn-sm btn-primary" href="customer_add.php?edit=<?=$v['Customer_ID']?>"><i class="fa fa-pencil-square-o"></i></a>
																	<!-- <a class="btn btn-sm btn-danger" href="hosting_list.php?delete=<?=$v['Customer_ID']?>"><i class="fa fa-times"></i></a> -->
																</td>
															</tr>	
														<?php endforeach ?>
													<?php else:?>
														<tr>
															<td colspan="10" class="text-center">Chưa có dữ liệu</td>
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
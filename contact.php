<html lang="en">
<head>

	<!-- Module Head -->
	<?php include('module/head.php');?>

	<title>Liên Hệ</title>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

  	<div class="page-wrapper">
  		
  		<!-- Module Header -->
  		<?php include('module/header.php');?>
    	

	    
	    <div class="container contact-page mt-5">
			<div class="row pt-3 mb-4">
			    <div class="col-lg-4 col-md-4"> <img class="contact-img" alt="Địa Chỉ" src="https://karaokethongminh.com/default/template/asset/contact1-v=325.png">
			        <div class="text-contact"> <span class="title-contact">Địa Chỉ</span> <span class="descript-contact">31/35 Đường Số 3, Phường 9, Quận Gò Vấp, TP.Hồ Chí Minh</span> </div>
			    </div>
			    <div class="col-lg-4 col-md-4"> <img class="contact-img" alt="Hotline liên hệ " src="https://karaokethongminh.com/default/template/asset/contact2-v=325.png">
			        <div class="text-contact"> <span class="title-contact">Hotline liên hệ </span> <span class="descript-contact">Mobile: <a href="tel:088.888.8267">088.888.8267</a></span><br> </div>
			    </div>
			    <div class="col-lg-4 col-md-4"> <img class="contact-img" alt="Email" src="https://karaokethongminh.com/default/template/asset/contact3-v=325.png">
			        <div class="text-contact"> <span class="title-contact">Email</span> <span class="descript-contact"><a href="mailto:sale@azshop247.vn">sale@azshop247.vn</a></span> </div>
			    </div>
			</div>

			<h2 class="text-center">Gửi tin nhắn cho chúng tôi</h2>
			<form action="" class="contact-form" method="post">
	            <div class="form-row">
                    <div class="input-box col-md-6"> <input type="text" size="35" class="input-text input-page-contact form-control" value="" name="Contact_Name" placeholder="Họ tên"> </div>
                    <div class="input-box col-md-6"> <input type="email" size="35" value="" class="input-text input-page-contact form-control" name="Contact_Email" placeholder="Email"> </div>
                </div>
                <div class="form-row my-2">
	                <div class="col-md-12"> 
	                	<textarea name="Contact_Message" class="input-text input-page-contact form-control" cols="150" rows="3" placeholder="Tin nhắn"></textarea>
	                </div>
	            </div>
	            <div class="buttons-set"> <input type="submit" class="btn button submit" value="GỬI TIN NHẮN"> </div>
	        </form>

	        <div class="row">
	        	<div class="col-lg-12">
                    <div class="google-map"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.552220653549!2d106.64865445018441!3d10.845538992236742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529983b7c9639%3A0xbf203a27c88a491d!2zMTksIDMwIMSQxrDhu51uZyBz4buRIDMsIFBoxrDhu51uZyA5LCBHw7IgVuG6pXAsIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2sus!4v1520939220287" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> </div>
                </div>
	        </div>
	    </div>
	
		
		<!-- Module Tags -->
		<?php include('module/tags.php');?>	
		
		<!-- Module Footer -->
		<?php include('module/footer.php');?>	
  	</div>


  	<!-- Main JS -->
	<?php include('module/js.php');?>

	<!-- Extra JS -->
    <script>
		$(".data-slider").owlCarousel({
			"items": 3,
			"margin": 40, 
			"smartSpeed": 700, 
			"autoplay": true, 
			"autoplayTimeout": 5000,
			"autoplayHoverPause": true, 
			"nav": false, 
			"navText": ["",""],
			"dots": false,
			"loop": true,
			"responsive": {
				"0": { "items": 1, "margin": 0},
				"575": { "items": 1, "margin": 0},
				"767": { "items": 1, "margin": 0},
				"991": { "items": 2, "margin": 40},
				"1199": { "items": 3, "margin": 40}
			}
		});

		$(".data-slider2").owlCarousel({
			"items": 3,
			"margin": 40, 
			"smartSpeed": 700, 
			"autoplay": true, 
			"autoplayTimeout": 5000,
			"autoplayHoverPause": true, 
			"nav": false, 
			"navText": ["",""],
			"dots": false,
			// "loop": true,
			"responsive": {
				"0": { "items": 1, "margin": 0},
				"575": { "items": 1, "margin": 0},
				"767": { "items": 1, "margin": 0},
				"991": { "items": 2, "margin": 40},
				"1199": { "items": 3, "margin": 40}
			}
		});

		$(".data-slider3").owlCarousel({
			"items": 3,
			"margin": 40, 
			"smartSpeed": 700, 
			"autoplay": true, 
			"autoplayTimeout": 5000,
			"autoplayHoverPause": true, 
			"nav": false, 
			"navText": ["",""],
			"dots": false,
			// "loop": true,
			"responsive": {
				"0": { "items": 1, "margin": 0},
				"575": { "items": 1, "margin": 0},
				"767": { "items": 1, "margin": 0},
				"991": { "items": 2, "margin": 40},
				"1199": { "items": 3, "margin": 40}
			}
		});
	</script>
</body>
</html>
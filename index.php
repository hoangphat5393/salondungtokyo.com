<!-- LIB -->
<?php require_once('index_c/index_c.php');?>

<?php 
    $atz = new index_controller();
?>

<!-- END LIB -->

<html lang="en">
<head>

	<!-- Module Head -->
	<?php include('modules/head.php');?>

    <!-- SEO -->
    <meta name="description" content="<?=SETTING['Setting_Description']?>">
    <meta name="keywords" content="<?=SETTING['Setting_Keywords']?>">

    <title><?=SETTING['Setting_Title']?></title>

</head>

<body>

    <!-- Main Header -->
    <?php include('modules/header.php')?>    


    <div class="page">
    	<!-- Main Slider -->
    	<?php include('modules/slider.php')?>
	</div>
	<!-- Content -->

    <section class="section-lg">

    	<div class="container">

    	    <div class="row justify-content-center" id="services">
    	        <div class="col-md-8">
    	            <h2 class="text-center">Dịch vụ làm tóc</h2>
    	            <p class="text-center">
                        Tiệm chúng tôi cung cấp các dịch vụ cắt tóc theo mẫu, làm tóc, nhuộm tóc, nhuộm lông mày và lông mi, uốn tóc duỗi tóc và nhiều dịch vụ khác.
                    </p>
    	        </div>
            </div>
            <div class="row mt-4 services">
                <div class="col-md-6 col-lg-4">
                    <div class="animate__animated animate__fadeInUp animate__slower">
                        <figure>
                            <img src="assets/images/haircuts.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                            <figcaption>Cắt tóc</figcaption>
                        </figure>
                        <div class="block-caption">
                            <h4><a class="services-name" href="#">Cắt tóc nữ</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="animate__animated animate__fadeInUp animate__slow">
                        <figure>
                            <img src="assets/images/cat_toc_nam.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc nam" title="Cắt tóc nam">
                            <figcaption>Cắt tóc nam</figcaption>
                        </figure>
                        <div class="block-caption">
                            <h4><a class="services-name" href="#">Cắt tóc nam</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/nhuom.jpg" class="img-fluid d-block mx-auto" alt="Nhuộm" title="Nhuộm">
                            <figcaption>Nhuộm</figcaption>
                        </figure>
                        <div class="block-caption">
                            <h4><a class="services-name" href="#">Nhuộm</a></h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/uon_toc.jpg" class="img-fluid d-block mx-auto" alt="Nhuộm" title="Nhuộm">
                            <figcaption>Uốn tóc</figcaption>
                        </figure>
                        <div class="block-caption">
                            <h4><a class="services-name" href="#">Uốn tóc</a></h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/phuc_hoi_toc.jpg" class="img-fluid d-block mx-auto" alt="Phục hồi tóc" title="Phục hồi tóc">
                            <figcaption>Phục hồi tóc</figcaption>
                        </figure>
                        <div class="block-caption">
                            <h4><a class="services-name" href="#">Phục hồi tóc</a></h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/dao_tao.jpg" class="img-fluid d-block mx-auto" alt="Đào tạo học viên" title="Đào tạo học viên">
                            <figcaption>Đào tạo học viên</figcaption>
                        </figure>
                        <div class="block-caption">
                            <h4><a class="services-name" href="#">Đào tạo học viên</a></h4>
                        </div>
                    </div>
                </div>
    	    </div>
    	</div>

    </section>

    <section class="section parallax-container">
        <div class="material-parallax parallax">
            <img src="assets/images/parallax-img-1.jpg" alt="" style="display: block; transform: translate3d(-50%, 3px, 0px);">
        </div>

        <div class="parallax-content section-xl context-dark text-center">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 wow-outer">
                        <div class="wow animate__animated animate__fadeInUp">
                            <h2>Dịch vụ làm tóc</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg portfolio">
        
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-center">Kiểu mẫu</h2>
                    <p class="text-center">Các kiểu mãu tóc tiệm chúng tôi phục vụ.</p>
                </div>
            </div>

            <div class="row mt-4 row-30">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/gallery1.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/gallery2.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/gallery3.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp">
                        <figure>
                            <img src="assets/images/gallery4.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp animate__slow">
                        <figure>
                            <img src="assets/images/gallery1.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp animate__slow">
                        <figure>
                            <img src="assets/images/gallery2.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp animate__slow">
                        <figure>
                            <img src="assets/images/gallery3.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="animate__animated animate__fadeInUp animate__slow">
                        <figure>
                            <img src="assets/images/gallery4.jpg" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section section-lg bg-dark-1 about-us">
        <div class="container">
            <div class="row justify-content-lg-between py-3">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-left">
                  <div class="wow animate__animated animate__slideInLeft" style="visibility: visible; animation-name: slideInLeft;">
                    <div class="decorative-square">
                        <img src="assets/images/home-3.jpg" class="img-fluid mx-auto d-block" alt="" width="443" height="360">
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 mb-4 mb-lg-0 wow-outer block-1 text-center text-lg-left">
                  <div class="wow animate__animated animate__slideInRight" style="visibility: visible; animation-name: slideInRight;">
                    <h2>Giới thiệu</h2>
                    <p class="p1 mt-3">Curl is one of the premier hair salons in Los Angeles, frequented not only by women but by men and kids as well.</p>
                    <p>Our hair salon has earned an incredible reputation as our professional team of hairstylists continues to work wonders on clients’ hair and enhance their assets through our services.</p>
                    <a class="button button-md button-primary" href="#">view more</a>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg bg-gray-1 pricing" id="pricing">
        <div class="container">
            <h2 class="text-center wow animate__animated animate__slideInUp1" style="visibility: visible;">Giá</h2>
            <div class="row mt-5">
                <div class="col-12 wow animate__animated animate__slideInUp1" style="visibility: visible;">
                    <div class="tabs-custom tabs-horizontal tabs-classic" id="tabs-1">
                        
                        <ul class="nav nav-tabs nav-tabs-classic">
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-1" data-toggle="tab">Cắt tóc</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-2" data-toggle="tab">Làm tóc</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-toggle="tab">Nhuộm</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-1-1">
                                <div class="box-event-modern">
                                    <div class="event-item-modern event-active">
                                        <p class="event-time">$10.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Cắt tóc nữ</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>Curl provides a long list of salon services that will have women looking fabulous. Women can treat themselves to just a haircut or they can also choose from any of our expert services.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$9.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Cắt tóc nam</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>A men’s haircut comes with a refreshing shampoo, stimulating scalp massage and an essential oil hot towel treatment.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$11.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Cắt tóc trẻ em</a></h4>
                                        <div class="event-item-modern-text">
                                            <p>A trip to our salon is always enjoyable for kids of all ages. While we service clients of all ages, the experience for children will make them feel special.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tabs-1-2">
                                <div class="box-event-modern">
                                    <div class="event-item-modern event-active">
                                        <p class="event-time">$20.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Blowout</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>A full blowout service at Curl  includes two washes, one wash using clarifying shampoo, and the other is completed with a Blowout Shampoo and thermal protectant.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$16.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Curls</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>Enjoy a great shape with a customized curly cut, trim or shaping that's designed to bring out the best in your curls and express your individuality.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$15.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">UpDo</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>An updo is a hairstyle that is completely pinned up. Whether it is a high ponytail with braiding included, a low side bun with twists, or anything in between, we can manage it.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$14.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Event HairStyling</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>If you have a special event coming up, then our event styling services for your hair are just what you need. Our team of stylists will make you look your best.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tabs-1-3">
                                <div class="box-event-modern">
                                    <div class="event-item-modern event-active">
                                        <p class="event-time">$10.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">All-over Hair Color</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>All -Over Hair Color is a single-process hair color with scalp-to-ends application, also known as a “solid color” service. Price depends on hair length.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$19.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Inoa Color</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>The ultimate in ammonia-free color that is gentler and healthier on your scalp.  We have 22 patents for a color that is pure, vibrant and more beautiful than ever.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$11.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">Retouch Lightener (Includes Toner)</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>This service is ideal for maintaining an all-over blonde look. Toner guarantees an excellent result. Price depends on hair length.</p>
                                        </div>
                                    </div>
                                    <div class="event-item-modern">
                                        <p class="event-time">$16.89</p>
                                        <h4 class="event-item-modern-title"><a href="#">6 Foil Highlight with Haircut &amp; Blow-Out</a></h4>
                                        <div class="event-item-modern-text">
                                          <p>This is a great service for a first-time highlight. Adds some highlight in the hairline and part. Limited to a total of 6 foils. Includes haircut and styling.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg bg-gray-1 contacts" id="contact">
        <div class="container">
            <div class="row justify-content-center row-2-columns-bordered">
                <div class="col-md-5 col-lg-5">
                    <h2 class="text-center text-sm-left">LIÊN HỆ</h2>
                    <div class="box-icon-modern d-flex">
                        <div class="box-icon-inner decorate-circle decorate-color-primary-light">
                            <i class="far fa-2x fa-fw fa-phone"></i>
                        </div>
                        <div class="box-icon-caption">
                            <h4><a href="tel:<?=str_replace(' ', '', SETTING['Setting_Phone'])?>"><?=SETTING['Setting_Phone']?></a></h4>
                        </div>
                    </div>

                    <div class="box-icon-modern d-flex">
                        <div class="box-icon-inner decorate-circle decorate-color-primary-light">
                            <i class="far fa-2x fa-fw fa-map"></i>
                        </div>
                        <div class="box-icon-caption">
                            <h4><a href="#"><?=SETTING['Setting_Address']?></a></h4>
                        </div>
                    </div>

                    <div class="box-icon-modern d-flex">
                        <div class="box-icon-inner decorate-circle decorate-color-primary-light">
                            <i class="far fa-2x fa-fw fa-paper-plane"></i>
                        </div>
                        <div class="box-icon-caption">
                            <h4><a href="mailto:<?=SETTING['Setting_Email']?>"><?=SETTING['Setting_Email']?></a></h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-lg-7">
                    <h2 class="text-center text-sm-left">ĐỂ LẠI THÔNG TIN</h2>
                    <!-- RD Mailform-->
                    <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="" novalidate="novalidate">
                        <div class="form-wrap rd-form-2-2">
                            <input class="form-input form-control-has-validation" id="contact-name" type="text" name="name"><span class="form-validation"></span>
                            <label class="form-label rd-input-label" for="contact-name">Tên</label>
                        </div>
                        <div class="form-wrap rd-form-2-2">
                            <input class="form-input form-control-has-validation" id="contact-email" type="email" name="email"><span class="form-validation"></span>
                            <label class="form-label rd-input-label" for="contact-email">Email</label>
                        </div>
                        <div class="form-wrap rd-form-2-2">
                            <label class="form-label rd-input-label" for="contact-message">Lời nhắn</label>
                            <textarea class="form-input form-control-has-validation form-control-last-child" id="contact-message" name="message"></textarea><span class="form-validation"></span>
                        </div>
                        <div class="row justify-content-left">
                            <div class="col-12 col-sm-7 col-lg-5">
                                <button class="button button-third" type="submit">Gửi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


	<!-- Button trigger modal -->
	<!-- <button type="button" class="btn btn-primary btn-absolute font-weight-bold " data-toggle="modal" data-target="#exampleModal">
		Đăng Ký<br>Nhận Báo Giá
	</button> -->
	
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content price-cover">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Đăng Ký Nhận Báo Giá</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<form id="contact-form" action="#" method="post">
					<div class="modal-body pb-0">
						<div class="row">
							<div class="col-lg-7">
								<img src="assets/images/sp-finance-1.jpg" class="w-100 mb-3">
							</div>
							<div class="col-lg-5">
								<div class="form-row mb-3">
									<div class="col-md-12">
										<input type="text" class="form-control" id="Contact_Name" name="Contact_Name" placeholder="Vui lòng nhập họ & tên">
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="col-md-12">
										<input type="text" class="form-control" id="Contact_Mobile" name="Contact_Mobile" placeholder="Vui lòng nhập số điện thoại">
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="col-md-12">
										<input type="email" class="form-control" id="Contact_Email" name="Contact_Email" placeholder="Vui lòng nhập email">
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="col-md-12">
										<textarea class="form-control" id="Contact_Message" name="Contact_Message" rows="4" placeholder="Để lại lời nhắn"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-row mb-3">
							<div class="col-md-12 text-center">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
								<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
								<button type="submit" name="submit-contact" class="btn btn-primary">Gửi</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div> 
	</div>

    <?php include('modules/footer.php');?>

  	<!-- Main JS -->
	<?php include('modules/js.php');?>

	<!-- Extra JS -->
	<script>
		// $(document).ready(function() {
		//   setTimeout(function() {
		// 	$('#exampleModal').modal('show');
		//   }, 10000);
		// });
	</script>

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
	</script>
</body>
</html>
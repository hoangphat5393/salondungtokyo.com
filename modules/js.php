<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="assets/jquery-3.6.1/jquery-3.6.1.min.js"></script>
<script src="assets/bootstrap-4.6.0/js/bootstrap.bundle.min.js"></script>

<!-- Extra -->
<script src="assets/owl.carousel-2.3.4/js/owl.carousel.min.js"></script>

<script src="assets/jquery-simplyscroll-2.1.1/jquery.simplyscroll.min.js"></script>

<!-- Jquery Validate -->
<script src="assets/jquery-validation-1.19.3/jquery.validate.min.js"></script>


<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/608d419262662a09efc3ea48/1f4jsg970';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
	})();
</script> -->
<!--End of Tawk.to Script-->

<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
	var chatbox = document.getElementById('fb-customer-chat');
	chatbox.setAttribute("page_id", "960024754044816");
	chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
	window.fbAsyncInit = function() {
		FB.init({
			xfbml            : true,
			version          : 'v15.0'
		});
	};

	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
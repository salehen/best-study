<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo isset($title) ? $title : 'Best Study' ?></title>
	<!-- favicon
		============================================ -->
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/admin/img/favicon.ico">
	<!-- meta-tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="url" content="<?php echo base_url() ?>" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //meta-tags -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- font-awesome -->
	<link href="<?php echo base_url() ?>assets/css/font-awesome.css" rel="stylesheet">
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
	    rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

	<link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet">
</head>

<body>
	<!-- header -->
	<div class="header-top">
		<div class="container">
			<div class="bottom_header_left">
				<p>
					<span class="fa fa-map-marker" aria-hidden="true"></span>New Kampshire Mshinon, USA
				</p>
			</div>
			<div class="bottom_header_right">
				<div class="bottom-social-icons">
					<a class="facebook" href="#">
						<span class="fa fa-facebook"></span>
					</a>
					<a class="twitter" href="#">
						<span class="fa fa-twitter"></span>
					</a>
					<a class="pinterest" href="#">
						<span class="fa fa-pinterest-p"></span>
					</a>
					<a class="linkedin" href="#">
						<span class="fa fa-linkedin"></span>
					</a>
				</div>
				<div class="header-top-righ">
					<?php 
						$id = $this->session->userdata('id');
						if($id){
					?>
					<a href="<?php echo base_url('dashboard') ?>">
						<span class="fa fa-dashboard" aria-hidden="true"></span>Dashboard
					</a>
						<?php } else{ ?>
					<a href="<?php echo base_url('login') ?>">
						<span class="fa fa-sign-out" aria-hidden="true"></span>Login
					</a>
					<?php } ?>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="header">
		<div class="content white">
			<nav class="navbar navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo base_url() ?>">
							<h1>
								<span class="fa fa-leanpub" aria-hidden="true"></span>Best Study
								<label>Education & Courses</label>
							</h1>
						</a>
					</div>
					<!--/.navbar-header-->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<nav class="link-effect-2" id="link-effect-2">
							<ul class="nav navbar-nav">
								<li class="<?php if($this->uri->segment(1)==""){echo 'active';}?>">
									<a href="<?php echo base_url() ?>" class="effect-3">Home</a>
								</li>
								<li class="<?php if($this->uri->segment(1)=="about"){echo 'active';}?>">
									<a href="<?php echo base_url('about') ?>" class="effect-3">About Us</a>
								</li>
								<li class="<?php if($this->uri->segment(1)=="course"){echo 'active';}?>">
									<a href="<?php echo base_url('course') ?>" class="effect-3">Courses</a>
								</li>
								<li class="<?php if($this->uri->segment(1)=="admission"){echo 'active';}?>">
									<a href="<?php echo base_url('admission') ?>" class="effect-3">Admission</a>
								</li>
								<!-- <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="icons.html">Web Icons</a>
										</li>
										<li>
											<a href="codes.html">Short Codes</a>
										</li>
									</ul>
								</li> -->
								<li class="<?php if($this->uri->segment(1)=="gallery"){echo 'active';}?>">
									<a href="<?php echo base_url('gallery') ?>" class="effect-3">Gallery</a>
								</li>
								<li class="<?php if($this->uri->segment(1)=="contact"){echo 'active';}?>">
									<a href="<?php echo base_url('contact') ?>" class="effect-3">Contact Us</a>
								</li>
							</ul>
						</nav>
					</div>
					<!--/.navbar-collapse-->
					<!--/.navbar-->
				</div>
			</nav>
		</div>
	</div>
	<?php
if (isset($pages)) {
    echo $pages;
}
?>
	<!-- footer -->
	<div class="mkl_footer">
		<div class="sub-footer">
			<div class="container">
				<div class="mkls_footer_grid">
					<div class="col-xs-4 mkls_footer_grid_left">
						<h4>Location:</h4>
						<p>educa mfdflimbg 1235, Ipswich,
							<br> Foxhall Road, USA</p>
					</div>
					<div class="col-xs-4 mkls_footer_grid_left">
						<h4>Mail Us:</h4>
						<p>
							<span>Phone : </span>001 234 5678</p>
						<p>
							<span>Email : </span>
							<a href="mailto:info@example.com">mail@example.com</a>
						</p>
					</div>
					<div class="col-xs-4 mkls_footer_grid_left">
						<h4>Opening Hours:</h4>
						<p>Working days : 8am-10pm</p>
						<p>Sunday
							<span>(closed)</span>
						</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="botttom-nav-allah">
					<ul>
						<li>
							<a href="<?php echo base_url() ?>">Home</a>
						</li>
						<li>
							<a href="<?php echo base_url('about') ?>">About Us</a>
						</li>
						<li>
							<a href="<?php echo base_url('courses') ?>">Courses</a>
						</li>
						<li>
							<a href="<?php echo base_url('admission') ?>">Join Us</a>
						</li>
						<li>
							<a href="<?php echo base_url('contact') ?>">Contact Us</a>
						</li>
					</ul>
				</div>
				<!-- footer-button-info -->
				<div class="footer-middle-thanks">
					<h2>Thanks For watching</h2>
				</div>
				<!-- footer-button-info -->
			</div>
		</div>
		<div class="footer-copy-right">
			<div class="container">
				<div class="allah-copy">
					<p>© 2018 Best Study. All rights reserved | Design by
						<a href="http://w3layouts.com/">W3layouts</a>
					</p>
				</div>
				<div class="footercopy-social">
					<ul>
						<li>
							<a href="#">
								<span class="fa fa-facebook"></span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="fa fa-twitter"></span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="fa fa-rss"></span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="fa fa-vk"></span>
							</a>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--/footer -->

	<!-- js files -->
	<!-- js -->
	<script src="<?php echo base_url() ?>assets/js/jquery-2.1.4.min.js"></script>
	<!-- bootstrap -->
	<script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
	<!-- stats numscroller-js-file -->
	<script src="<?php echo base_url() ?>assets/js/numscroller-1.0.js"></script>
	<!-- //stats numscroller-js-file -->

	<!-- Flexslider-js for-testimonials -->
	<script>
		$(window).load(function () {
			$("#flexiselDemo1").flexisel({
				visibleItems: 1,
				animationSpeed: 1000,
				autoPlay: false,
				autoPlaySpeed: 3000,
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: {
					portrait: {
						changePoint: 480,
						visibleItems: 1
					},
					landscape: {
						changePoint: 640,
						visibleItems: 1
					},
					tablet: {
						changePoint: 768,
						visibleItems: 1
					}
				}
			});

		});
	</script>
	<script src="<?php echo base_url() ?>assets/js/jquery.flexisel.js"></script>
	<!-- //Flexslider-js for-testimonials -->
	<!-- smooth scrolling -->
	<script src="<?php echo base_url() ?>assets/js/SmoothScroll.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/move-top.js"></script>
	<script src="<?php echo base_url() ?>assets/js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script>
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //here ends scrolling icon -->
	<!-- smooth scrolling -->
	<!-- //js-files -->
	<?php
	if (isset($js) && $js) {
		foreach ($js as $data) {
			echo "<script src='" . base_url($data) . ".js'></script>";
		}
	}
	?>
</body>

</html>

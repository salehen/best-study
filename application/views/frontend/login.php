<!-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=809389779863625&autoLogAppEvents=1" nonce="AxFnWlk1"></script> -->
<!-- banner -->
<div class="inner_page_agile">

</div>
<!--//banner -->
<!-- short-->
<div class="services-breadcrumb">
	<div class="inner_breadcrumb">
		<ul class="short_ls">
			<li>
				<a href="index.html">Home</a>
				<span>| |</span>
			</li>
			<li>Login</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">
		<div class="title-div">
			<h3 class="tittle">
				<span>L</span>ogin
				<span>F</span>orm
			</h3>
			<div class="tittle-style">

			</div>
		</div>
		<?php
		$msg = $this->session->flashdata('msg');
		if (isset($msg) && $msg) {
			echo "<span class='ar-danger' align='center'><p>$msg</p></span><br>";
		}
		?>
		<div class="login-form">
			<form action="<?php echo base_url('login/check') ?>" method="post" novalidate>
				<div class="">
					<p>E-mail</p>
					<input type="text" class="name" name="email" required="" value="<?php echo set_value('email') ?>" />
				</div>
				<span class="ar-danger"> <?php echo form_error('email') ?></span>
				<div class="">
					<p>Password</p>
					<input type="text" class="password" name="password" required="" />
				</div>
				<span class="ar-danger"> <?php echo form_error('password') ?></span>
				<div class="">
					<p>User Type</p>
					<select name="userType" id="userType" required class="">
						<option value="">Select User Type</option>
						<option value="1" <?php echo (set_value('userType') == 1) ? 'selected' : '' ?>>Admin</option>
						<option value="2" <?php echo (set_value('userType') == 2) ? 'selected' : '' ?>>Teacher</option>
						<option value="3" <?php echo (set_value('userType') == 3) ? 'selected' : '' ?>>Guardian</option>
						<option value="4" <?php echo (set_value('userType') == 4) ? 'selected' : '' ?>>Student</option>
					</select>
				</div>
				<span class="ar-danger"> <?php echo form_error('userType') ?></span>
				<label class="anim">
					<input type="checkbox" class="checkbox" name='remember_me'>
					<span> Remember me ?</span>
				</label>
				<div class="login-agileits-bottom wthree">
					<h6>
						<a href="<?php echo base_url('forgat-password') ?>">Forgot password?</a>
					</h6>
				</div>
				<input type="submit" value="Login">
				<!-- <div class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true" data-width="250"></div> -->
				<?php
				echo '<h4 class="pager"><a href="' . $this->facebook->login_url() . '" class="facebook"><span class="fa fa-facebook"></span> Facebook Login</a></h4>';
				?>
				<div class="register-forming">
					<p>To Register New Account --
						<a href="register.html">Click Here</a>
					</p>
				</div>
			</form>
		</div>

	</div>
</div>

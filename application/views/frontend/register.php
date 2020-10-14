<!-- banner -->
<div class="inner_page_agile">

</div>
<!--//banner -->
<!-- short-->
<div class="services-breadcrumb">
	<div class="inner_breadcrumb">
		<ul class="short_ls">
			<li>
				<a href="<?php echo base_url() ?>">Home</a>
				<span>| |</span>
			</li>
			<li>Register</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">
		<div class="title-div">
			<h3 class="tittle">
				<span>R</span>egister
				<span>F</span>orm
			</h3>
			<div class="tittle-style">

			</div>
		</div>
		<div class="login-form">
			<form action="<?php echo base_url('register/check') ?>" method="post" novalidate enctype="multipart/form-data">
				<div class="">
					<p>User Name </p>
					<input type="text" class="name" name="user_name" required value="<?php echo set_value('user_name') ?>" />
					<?php echo form_error('user_name') ?>
				</div>
				<div class="">
					<p>E-mail</p>
					<input type="email" class="password" name="email" required="" value="<?php echo set_value('email') ?>" />
					<?php echo form_error('email') ?>
				</div>
				<div class="">
					<p>Password</p>
					<input type="password" class="password" name="password" id="password1" required="" />
					<?php echo form_error('password') ?>
				</div>
				<div class="">
					<p>Confirm Password</p>
					<input type="password" class="password" name="rPassword" id="password2" required="" />
					<?php echo form_error('rPassword') ?>
				</div>
				<label class="anim">
					<input type="checkbox" class="checkbox" name="agreement">
					<span>I Accept Terms & Conditions</span>
					<?php echo form_error('agreement') ?>
				</label>
				<input type="submit" value="Register">
			</form>
		</div>

	</div>
</div>

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
			<li>Set New Password</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">
		<div class="title-div">
			<h3 class="tittle">
			<span>N</span>ew
				<span>P</span>assword
			</h3>
			<div class="tittle-style">
			</div>
		</div>
		<div class="login-form">
			<form action="<?php echo base_url('confirm-password') ?>" method="post" novalidate>
				<div class="fields-grid">
					<div class="">
						<p>New Password</p>
						<input type="password" class="name" name="password" required=""/>
					</div>
					<span class="ar-danger"> <?php echo form_error('password') ?></span>
					<div class="">
						<p>Confirm Password</p>
						<input type="password" class="name" name="cPassword" required=""/>
					</div>
					<span class="ar-danger"> <?php echo form_error('cPassword') ?></span>

					<div class="clearfix"> </div>
				</div>
				<input type="submit" value="Confirm">
			</form>
		</div>
	</div>
</div>

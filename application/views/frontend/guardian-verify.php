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
			<li>Guardian Verification</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">
		<div class="title-div">
			<h3 class="tittle">
				<span>G</span>uardian
				<span>V</span>erification
			</h3>
			<div class="tittle-style">

			</div>
		</div>
		<div class="login-form">
			<form action="<?php echo base_url('guardian-confirm') ?>" method="post" novalidate enctype="multipart/form-data">
				<?php
				foreach ($guardianInfo as $st) {
				?>
					<div class="">
						<p>Name </p>
						<input type="text" class="name" name="user_name" readonly value="<?php echo $st->name ?>" />
					</div>
					<div class="">
						<p>E-Mail </p>
						<input type="text" class="name" name="user_name" readonly value="<?php echo $st->email ?>" />
					</div>
					<div class="">
						<p>Phone </p>
						<input type="text" class="name" name="user_name" readonly value="<?php echo $st->mobile ?>" />
					</div>

					<div class="">
						<p>Designation *</p>
						<input type="text" class="des" name="des" id="des" required="" value="<?php echo set_value('des') ?>" />
						<span class="ar-danger"><?php echo form_error('des') ?></span>
					</div>
					<div class="">
						<p>Password *</p>
						<input type="password" class="password" name="password" id="password1" required="" />
						<span class="ar-danger"><?php echo form_error('password') ?></span>
					</div>
					<div class="">
						<p>Confirm Password *</p>
						<input type="password" class="password" name="rPassword" id="password2" required="" />
						<span class="ar-danger"><?php echo form_error('rPassword') ?></span>
					</div>
					<div class="styled-input">
						<label class="header">Your Address</label>

						<div class="">
							<p>Address</p>
							<input type="text" name="address" placeholder="Address" title="Please enter your Address" required="" value="<?php echo set_value('address') ?>">
							<span class="ar-danger"> <?php echo form_error('address') ?></span>
						</div>

						<div class="styled-input agile-styled-input-top">
							<p>Country</p>
							<select class="category2 dropdown country" name="country" required="" title="Please enter your Country">
								<option value="">Select Country</option>
								<?php
								foreach ($country as $k => $v) {
								?>
									<option value="<?php echo $v->id ?>" <?php echo  set_select('country', $v->id, false); ?>><?php echo $v->name ?></option>
								<?php
								}
								?>
							</select>
							<span class="ar-danger"> <?php echo form_error('country') ?></span>
						</div>

						<div class="styled-input agile-styled-input-top">
							<p>City</p>
							<select class="category2 dropdown city" name="city" required="" title="Please enter your City">
								<option value="">Select Country First</option>
								<option value="<?php echo set_value('city') ?>" <?php echo  set_select('city', set_value('city'), false); ?>><?php echo set_value('city') ?></option>
							</select>
							<span class="ar-danger"> <?php echo form_error('city') ?></span>
						</div>

						<div class="">
							<p>Post Code</p>
							<input type="text" name="post_code" placeholder="Post Code" title="Please enter your Post code" required="" value="<?php echo set_value('post_code') ?>">
							<span class="ar-danger"> <?php echo form_error('post_code') ?></span>
						</div>

						<div class="">
							<p>Picture</p>
							<input type="file" class="pic-input" name="picture" placeholder="Picture" title="Please Select Your Picture" required="" value="<?php echo set_value('picture') ?>">
							<span class="ar-danger"> <?php echo form_error('picture') ?></span>
						</div>
						<!-- <div class="file-upload-inner ts-forms">
							<div class="input prepend-big-btn">
								<label class="icon-right" for="prepend-big-btn">
									<i class="fa fa-download"></i>
								</label>
								<div class="file-button">
									Browse
									<input type="file" onchange="document.getElementById('prepend-big-btn').value = this.value;">
								</div>
								<input type="text" id="prepend-big-btn" placeholder="no file selected">
							</div>
						</div>
					</div> -->

					<input type="hidden" name="gid" value="<?php echo $st->id ?>">
					<input type="submit" value="Submit">
				<?php } ?>
			</form>
		</div>

	</div>
</div>

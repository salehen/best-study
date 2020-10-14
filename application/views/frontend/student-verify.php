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
			<li>Student Verification</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">
		<div class="title-div">
			<h3 class="tittle">
				<span>S</span>tudent
				<span>V</span>erification
			</h3>
			<div class="tittle-style">

			</div>
		</div>
		<div class="login-form">
			<form action="<?php echo base_url('student-confirm') ?>" method="post" novalidate enctype="multipart/form-data">
				<?php
				foreach ($studentInfo as $st) {
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
						<p>Class </p>
						<input type="text" class="name" name="user_name" readonly value="<?php echo $st->cname ?>" />
					</div>
					<div class="">
						<p>Section </p>
						<input type="text" class="name" name="user_name" readonly value="<?php echo $st->sname ?>" />
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
						<label class="header">Guardian Information</label><br>
						<div class="anim">
							<input type="checkbox" class="checkbox" name="gar" id="gar" value="1" <?php echo set_checkbox('gar', '1', false); ?>>
							<label for="gar">Guardian Already Register </label>
						</div>
						<div class="gname">
							<p>Name </p>
							<input type="text" name="gname" placeholder="Guardian Name" title="Please enter your Guardian Name" required="" value="<?php echo set_value('gname') ?>">
							<span class="ar-danger"> <?php echo form_error('gname') ?></span>
						</div>

						<div class="gEmail">
							<p>E-Mail </p>
							<input type="email" name="gEmail" placeholder="Guardian E-Mail" title="Please enter your Guardian E-Mail" required="" value="<?php echo set_value('gEmail') ?>">
							<span class="ar-danger" id="chackEmail"></span>
							<span class="ar-danger"> <?php echo form_error('gEmail') ?></span>
						</div>

						<div class="gmobile">
							<p>Mobile </p>
							<input type="text" name="gmobile" placeholder="Guardian Mobile Number" title="Please enter your Guardian Mobile Number" required="" value="<?php echo set_value('gmobile') ?>">
							<span class="ar-danger"> <?php echo form_error('gmobile') ?></span>
						</div>

						<div class="relation">
							<p>Relation With Guardian </p>
							<input type="text" name="relation" placeholder="Relation With Guardian" title="Please enter Relation With Guardian" required="" value="<?php echo set_value('relation') ?>">
							<span class="ar-danger"> <?php echo form_error('relation') ?></span>
						</div>
					</div>
					<!-- <label class="anim">
						<input type="checkbox" class="checkbox" name="agreement">
						<span>I Accept Terms & Conditions</span>
						<?php // echo form_error('agreement') ?>
					</label> -->
					<input type="hidden" name="sid" value="<?php echo $st->id ?>">
					<input type="submit" value="Submit">
				<?php } ?>
			</form>
		</div>

	</div>
</div>

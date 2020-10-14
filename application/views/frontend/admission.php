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
			<li>Admission</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">

		<?php
		if (isset($setupList)) {
		?>

			<div id="notes_bored">
				<div class="title-div">
					<h3 class="tittle">
						<span>A</span>dmission
						<span>N</span>otes
					</h3>
					<div class="tittle-style">
					</div>
				</div>
				<table id="mydataTable" class="table table-bordered table-hover table-striped display text-center" style="width:100%">
					<thead>
						<tr class="info">
							<th>Class</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Exam Type</th>
							<th>Exam Date</th>
							<th>Total Marks</th>
							<th>Pass Marks</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody id="atbody" class='align-center'>
						<?php
						foreach ($setupList as $sl) {
							$currentDate = new DateTime(date('Y-m-d H:i:s'));
							$startDate = new DateTime($sl->start_date);
							$endDate = new DateTime($sl->end_date);
							$intervalFromStart = $currentDate->diff($startDate);
							$intervalFromEnd = $currentDate->diff($endDate);
							$startEnd = $startDate->diff($endDate);

							if ($intervalFromStart->format('%R%a%h%i%s') > 0 && $intervalFromEnd->format('%R%a%h%i%s') > 0 && $startEnd->format('%R%a%h%i%s') > 0) {
								$status = "<td class='alert-info'><b>Upcoming</b></dt>";
							} elseif ($intervalFromStart->format('%R%a%h%i%s') < 0 && $intervalFromEnd->format('%R%a%h%i%s') > 0 && $startEnd->format('%R%a%h%i%s') > 0) {
								$status = "<td class='alert-success btn button btn-block apply_now' cid='".$sl->class_id."'><b>Apply Now</b></dt>";
							} elseif ($intervalFromEnd->format('%R%a%h%i%s') < 0 && $startEnd->format('%R%a%h%i%s') > 0) {
								$status = "<td class='alert-danger'><b>Expired</b></dt>";
							} else {
								$status = "<td class='alert-warning'><b>Wrong Date</b></dt>";
							}
						?>
							<tr class='align-center'>
								<td><?php echo $sl->cname ?></td>
								<td><?php echo $sl->start_date ?></td>
								<td><?php echo $sl->end_date ?></td>
								<td><?php echo $sl->exam_type ?></td>
								<td><?php echo $sl->exam_date ?></td>
								<td><?php echo $sl->total_marks ?></td>
								<td><?php echo $sl->pass_marks ?></td>
								<?php echo $status ?>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		<?php
		}
		?>
		<div class='admission-form'>
			<div class="title-div">
				<h3 class="tittle">
					<span>A</span>dmission
					<span>F</span>orm
				</h3>
				<div class="tittle-style">
				</div>
			</div>
			<div class="register-form">
				<span class="ar-danger">
					<p>*Place fill-up this form carefully. After submit edit is not possible. </p>
				</span>
				<form action="<?php echo base_url('admission/check') ?>" method="post" novalidate enctype="multipart/form-data">
					<div class="fields-grid">
						<span class="ar-danger"> <?php echo form_error('name') ?></span>
						<div class="styled-input">
							<input type="text" placeholder="Your Name" name="name" required="" value="<?php echo set_value('name') ?>">
						</div>
						<span class="ar-danger"> <?php echo form_error('fa_name') ?></span>
						<div class="styled-input">
							<input type="text" placeholder="Father Name" name="fa_name" required="" value="<?php echo set_value('fa_name') ?>">
						</div>
						<span class="ar-danger"> <?php echo form_error('mo_name') ?></span>
						<div class="styled-input">
							<input type="text" placeholder="Mother Name" name="mo_name" required="" value="<?php echo set_value('mo_name') ?>">
						</div>
						<span class="ar-danger"> <?php echo form_error('bi_date') ?></span>
						<div class="styled-input">
							<input type="date" id="datepicker" placeholder="Birth Date" name="bi_date" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="" value="<?php echo set_value('bi_date') ?>" class="date-picker">
						</div>
						<span class="ar-danger"> <?php echo form_error('gender') ?></span>
						<div class="styled-input agile-styled-input-top">
							<select class="category2" name="gender" required="">
								<option value="">Gender</option>
								<option value="1">Female</option>
								<option value="2">Male</option>
								<option value="3">Other</option>
							</select>
						</div>
						<span class="ar-danger"> <?php echo form_error('email') ?></span>
						<span id="chackEmail" class="ar-danger"></span>
						<div class="styled-input">
							<input type="email" placeholder="Your E-mail" name="email" required="" value="<?php echo set_value('email') ?>">
						</div>
						<span class="ar-danger"> <?php echo form_error('phone') ?></span>
						<div class="styled-input">
							<input type="text" placeholder="Phone Number" name="phone" required="" value="<?php echo set_value('phone') ?>">
						</div>
						<span class="ar-danger"> <?php echo form_error('class') ?></span>
						<div class="styled-input agile-styled-input-top">
							<select class="category2" name="class" required="" id="class">
								<option value="">Select class</option>
								<?php
								foreach ($sub as $k => $v) {
								?>
									<option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
								<?php
								}
								?>
							</select>
							<span></span>
						</div>
						<span class="ar-danger"> <?php echo form_error('section') ?></span>
						<div class="styled-input">
							<div class="agileits_w3layouts_grid">
								<select class="category2" name="section" required="" id="section">
									<option value="">Select Class First</option>

								</select>
							</div>
						</div>
						<span class="ar-danger"> <?php echo form_error('nationality') ?></span>
						<div class="styled-input">
							<input type="text" placeholder="Nationality" name="nationality" required="" value="<?php echo set_value('nationality') ?>">
						</div>

						<div class="styled-input">
							<label class="header">Your Address</label>
							<span class="ar-danger"> <?php echo form_error('address') ?></span>
							<div class="">
								<input type="text" name="address" placeholder="Address" title="Please enter your Address" required="" value="<?php echo set_value('address') ?>">
							</div>
							<span class="ar-danger"> <?php echo form_error('country') ?></span>
							<div class="">
								<input type="text" name="country" placeholder="Country" title="Please enter your Country" required="" value="<?php echo set_value('country') ?>">
							</div>
							<span class="ar-danger"> <?php echo form_error('city') ?></span>
							<div class="">
								<input type="text" name="city" placeholder="City" title="Please enter your City" required="" value="<?php echo set_value('city') ?>">
							</div>
							<span class="ar-danger"> <?php echo form_error('post_code') ?></span>
							<div class="">
								<input type="text" name="post_code" placeholder="Post Code" title="Please enter your Post code" required="" value="<?php echo set_value('post_code') ?>">
							</div>
							<span class="ar-danger"> <?php echo form_error('picture') ?></span>
							<div class="">
								<input type="file" name="picture" placeholder="Picture" title="Please Select Your Picture" required="" value="<?php echo set_value('picture') ?>">
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	</div>
</div>

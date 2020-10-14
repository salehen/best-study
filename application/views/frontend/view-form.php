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
			<li>Form Information</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">
		<div class="title-div">
			<h3 class="tittle">
				<span>V</span>iew
				<span>A</span>dmission
				<span>F</span>orm
			</h3>
			<div class="tittle-style">
			</div>
		</div>
			<div class="register-form">
				<?php foreach ($formData as $data) {?>
			<form action="" method="post" novalidate enctype="multipart/form-data">
				<div class="fields-grid">
					<div class="styled-input">
						<label>Student Name :</label>
						<input type="text" placeholder="Your Name" name="name" required="" value="<?php echo $data->name ?>" readonly>
					</div>
					<div class="styled-input">
					<label>Father Name :</label>
						<input type="text" placeholder="Father Name" name="fa_name" required="" value="<?php echo $data->father_name ?>" readonly>
					</div>
					<div class="styled-input">
						<label>Mother Name :</label>
						<input type="text" placeholder="Mother Name" name="mo_name" required="" value="<?php echo $data->mother_name ?>" readonly>
					</div>
					<div class="styled-input">
					<label>Birth Date :</label>
						<input id="datepicker" placeholder="Birth Date" name="bi_date" type="text" value="<?php echo $data->birth_date ?>" readonly>
					</div>
					<div class="styled-input agile-styled-input-top">
					<label>Gender :</label>
						<input type="text" name="gender" required="" value="<?php 
							if($data->gender == 1) {
								echo "Male";
							} elseif ($data->gender == 2){
								echo "Female";
							} elseif ($data->gender == 3){
								echo "Other";
							}
						?>" readonly>
					</div>
					<div class="styled-input">
					<label>E-mail :</label>
						<input type="email" placeholder="Your E-mail" name="email" required="" value="<?php echo $data->email ?>" readonly>
					</div>
					<div class="styled-input">
					<label>Phone Number :</label>
						<input type="text" placeholder="Phone Number" name="phone" required="" value="<?php echo $data->phone ?>" readonly>
					</div>
					<div class="styled-input agile-styled-input-top">
					<label>Class :</label>
						<select class="category2" name="class" required="" disabled>
							<option value="1" <?php echo ($data->class == 1)? "selected" : ''?>>Web Designing</option>
							<option value="2" <?php echo ($data->class == 2)? "selected" : ''?>>Web Technology </option>
							<option value="3" <?php echo ($data->class == 3)? "selected" : ''?>>PC Systems </option>
							<option value="4" <?php echo ($data->class == 4)? "selected" : ''?>>IT Foundations </option>
							<option value="5" <?php echo ($data->class == 5)? "selected" : ''?>>HR Management </option>
							<option value="6" <?php echo ($data->class == 6)? "selected" : ''?>>Modeling </option>
							<option value="7" <?php echo ($data->class == 7)? "selected" : ''?>>Basic Marketing</option>
						</select>
						<span></span>
					</div>
					<div class="styled-input">
						<div class="agileits_w3layouts_grid">
						<label>Section :</label>
							<select class="category2" name="section" required="" disabled>
								<option value="1" <?php echo ($data->section_id == 1)? "selected" : ''?>>A</option>
								<option value="2" <?php echo ($data->section_id == 2)? "selected" : ''?>>B</option>
								<option value="3" <?php echo ($data->section_id == 3)? "selected" : ''?>>C</option>
								<option value="4" <?php echo ($data->section_id == 4)? "selected" : ''?>>D</option>
								<option value="5" <?php echo ($data->section_id == 5)? "selected" : ''?>>E</option>
							</select>
						</div>
					</div>
					<div class="styled-input">
					<label>Nationality :</label>
						<input type="text" placeholder="Nationality" name="nationality" required="" value="<?php echo $data->nationality ?>" readonly>
					</div>
					
					<div class="styled-input">
						<label class="header">Your Address</label>
						<div class="">
						<label>Address :</label>
							<input type="text" name="address" placeholder="Address" title="Please enter your Address" required="" value="<?php echo $data->address ?>" readonly>
						</div>
						<div class="">
							<label for="">Country</label>
							<input type="text" name="country" placeholder="Country" title="Please enter your Country" required="" value="<?php echo $data->country ?>" readonly>
						</div>
						<div class="">
						<label for="">City</label>
							<input type="text" name="city" placeholder="City" title="Please enter your City" required="" value="<?php echo $data->city ?>" readonly>
						</div>
						<div class="">
						<label for="">Post Code</label>
							<input type="text" name="post_code" placeholder="Post Code" title="Please enter your Post code" required="" value="<?php echo $data->post_code ?>" readonly>
						</div>
						<div class="">
						<img src="<?php echo base_url()?>assets/images/admission/<?php echo $data->id.'_org.'.$data->picture?>" alt="Picture" width="150">						
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<?php } ?>
			</form>
		</div>
	</div>
</div>

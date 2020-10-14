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
			<li>Forgat Password</li>
		</ul>
	</div>
</div>
<!-- //short-->
<div class="register-form-main">
	<div class="container">
		<div class="title-div">
			<h3 class="tittle">
				<span>F</span>orgat
				<span>P</span>assword
			</h3>
			<div class="tittle-style">

			</div>
		</div>
		<?php 
		$msg = $this->session->flashdata('msg');
		if(isset($msg) && $msg){
			echo "<span class='ar-danger' align='center'><p>$msg</p></span><br>";
		} 
		?>
		<div class="login-form">
			<form action="<?php echo base_url('reset-password') ?>" method="post" novalidate>
				<div class="">
					<p>Enter Your E-mail</p>
					<input type="text" class="name" name="email" required="" value="<?php echo set_value('email') ?>"/>
				</div>
				<span class="ar-danger"> <?php echo form_error('email') ?></span>
				<input type="submit" value="Submit">				
			</form>
		</div>

	</div>
</div>

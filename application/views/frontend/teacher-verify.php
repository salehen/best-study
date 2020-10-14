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
            <li>Teacher Verification</li>
        </ul>
    </div>
</div>
<!-- //short-->
<div class="register-form-main">
    <div class="container">
        <div class="title-div">
            <h3 class="tittle">
                <span>T</span>eacher
                <span>V</span>erification
            </h3>
            <div class="tittle-style">

            </div>
        </div>
        <div class="login-form">
            <form action="<?php echo base_url('teacher-confirm') ?>" method="post" novalidate enctype="multipart/form-data">
                <?php
                foreach ($teacherInfo as $st) {
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
                        <p>Designation </p>
                        <input type="text" class="name" name="user_name" readonly value="<?php echo $st->designation ?>" />
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
                    <div class="">
                        <p>Picture</p>
                        <input type="file" class="pic-input" name="picture" placeholder="Picture" title="Please Select Your Picture" required="" value="<?php echo set_value('picture') ?>">
                        <span class="ar-danger"> <?php echo form_error('picture') ?></span>
                    </div>
                    <input type="hidden" name="tid" value="<?php echo $st->id ?>">
                    <input type="submit" value="Submit">
                <?php } ?>
            </form>
        </div>

    </div>
</div>
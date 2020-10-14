        <!-- Single pro tab review Start-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
            <div class="tab-content-details shadow-reset">
                <h2>Add Teacher</h2>
                <?php
                $msg = $this->session->flashdata('msg');
                if (isset($msg) && $msg) {
                    echo "<span class='ar-danger' align='center'><p>$msg</p></span><br>";
                }
                ?>
            </div>
        </div>
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Basic Information</a></li>
                                <li><a href="#reviews"> Account Information</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">

                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action="<?php echo base_url('dashboard/add-teacher/check') ?>" method="POST" novalidate class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input name="name" type="text" required class="form-control" placeholder="Full Name" value="<?php echo set_value('name') ?>">
                                                                    <span class="ar-danger"> <?php echo form_error('name') ?></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <select name="gender" class="form-control">
                                                                        <option value="none" selected="" disabled="">Select Gender</option>
                                                                        <option value="1" <?php echo  set_select('gender', 1, false); ?>>Male</option>
                                                                        <option value="2" <?php echo  set_select('gender', 2, false); ?>>Female</option>
                                                                        <option value="3" <?php echo  set_select('gender', 3, false); ?>>Other</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="address" type="text" class="form-control" placeholder="Address" value="<?php echo set_value('address') ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <select class="form-control country" name="country" required="" title="Please enter your Country">
                                                                        <option value="">Select Country</option>
                                                                        <?php
                                                                        foreach ($country as $k => $v) {
                                                                        ?>
                                                                            <option value="<?php echo $v->id ?>" <?php echo  set_select('country', $v->id, false); ?>><?php echo $v->name ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <select class="category2 dropdown city form-control" name="city" required="" title="Please enter your City">
                                                                        <option value="">Select Country First</option>
                                                                        <option value="<?php echo set_value('city') ?>" <?php echo  set_select('city', set_value('city'), false); ?>><?php echo set_value('city') ?></option>
                                                                    </select>
                                                                    <span class="ar-danger"> <?php echo form_error('city') ?></span>
                                                                </div>

                                                                <div class="form-form-group">
                                                                    <input type="number" name="post_code" placeholder="Post Code" title="Please enter your Post code" required="" value="<?php echo set_value('post_code') ?>" class='form-control'>
                                                                    <span class="ar-danger">
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email') ?>">
                                                                    <span class="ar-danger"> <?php echo form_error('email') ?></span>
                                                                    <span id="chackEmail" class="ar-danger"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="mobile" type="number" class="form-control" placeholder="Phone" value="<?php echo set_value('mobile') ?>">
                                                                    <span class="ar-danger"> <?php echo form_error('mobile') ?></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="subject" required="" title="Please enter your Country">
                                                                        <option value="" disabled selected>Select Subject</option>
                                                                        <?php
                                                                        foreach ($subject as $k => $v) {
                                                                        ?>
                                                                            <option value="<?php echo $v->id ?>" <?php echo  set_select('subject', $v->id, false); ?>><?php echo $v->name ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="ar-danger"> <?php echo form_error('subject') ?></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="designation" type="text" class="form-control" placeholder="Designation" value="<?php echo set_value('designation') ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="employee_id" type="text" class="form-control" placeholder="Employee ID" value="<?php echo set_value('employee_id') ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="joining_date">joining date</label>
                                                                    <input name="joining_date" id="joining_date" type="date" class="form-control" placeholder="joining date" value="<?php echo set_value('joining_date') ?>">
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="reviews">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <form id="acount-infor" action="#" class="acount-infor">
                                                            <div class="devit-card-custom">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="phoneno" type="number" class="form-control" placeholder="Phone">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="password" type="password" class="form-control" placeholder="Password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="confarmpassword" type="password" class="form-control" placeholder="Confirm Password">
                                                                </div>
                                                                <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
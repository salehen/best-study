     <!-- tabs start-->
     <div class="admintab-area mg-b-15">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                     <div class="tab-content-details shadow-reset">
                         <h2>Add Exam Schedule</h2>
                         <p>Add Application Start Data and End Date, Exam Date or viva Date, How to evaluated in Admission Exam.</p>
                     </div>
                 </div>
                 <?php
                    $msg = $this->session->flashdata('msg');
                    if (isset($msg) && $msg) {
                        echo "<span class='ar-success' align='center'><p>$msg</p></span><br>";
                    }
                    ?>
             </div>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="admintab-wrap edu-tab1 mg-t-30">
                     <form class="form-horizontal" action="<?php echo base_url('dashboard/add-exam/check') ?>" method="POST">
                         <div class="form-group">
                             <label class="col-sm-2 control-label">Class</label>
                             <div class="col-sm-10">
                                 <select name="class" id="class" class="form-control class">
                                     <option value="" disabled selected>Select Class</option>
                                     <?php
                                        foreach ($class as $cl) {
                                        ?>
                                         <option value="<?php echo $cl->id ?>" <?php echo  set_select('class', $cl->id, false); ?>><?php echo $cl->name ?></option>
                                     <?php } ?>
                                 </select>
                                 <span class="ar-danger"> <?php echo form_error('class') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">Section</label>
                             <div class="col-sm-10">
                                 <select name="section" id="section" class="form-control section">
                                     <option value="" disabled selected>Select Class First</option>
                                 </select>
                                 <span class="ar-danger"> <?php echo form_error('section') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">Subject</label>
                             <div class="col-sm-10">
                                 <select name="subject" id="subject" class="form-control class">
                                     <option value="" disabled selected>Select Subject</option>
                                     <?php
                                        foreach ($subject as $cl) {
                                        ?>
                                         <option value="<?php echo $cl->id ?>" <?php echo  set_select('subject', $cl->id, false); ?>><?php echo $cl->name ?></option>
                                     <?php } ?>
                                 </select>
                                 <span class="ar-danger"> <?php echo form_error('subject') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">Exam Type</label>
                             <div class="col-sm-10">
                                 <select name="exam_type" id="exam_type" class="form-control class">
                                     <option value="" disabled selected>Select Exam Type</option>
                                     <?php
                                        foreach ($exam_type as $cl) {
                                        ?>
                                         <option value="<?php echo $cl->id ?>" <?php echo  set_select('exam_type', $cl->id, false); ?>><?php echo $cl->name ?></option>
                                     <?php } ?>
                                 </select>
                                 <span class="ar-danger"> <?php echo form_error('exam_type') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="exam_date" class="col-sm-2 control-label">Exam Date</label>
                             <div class="col-sm-10">
                                 <input type="date" class="form-control" id="exam_date" name="exam_date" value="<?php echo set_value('exam_date') ?>">
                                 <span class="ar-danger"> <?php echo form_error('exam_date') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="start_time" class="col-sm-2 control-label">Exam Start Time</label>
                             <div class="col-sm-10">
                                 <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo set_value('start_time') ?>">
                                 <span class="ar-danger"> <?php echo form_error('start_time') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="duration" class="col-sm-2 control-label">Duration</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control" id="duration" name="duration" value="<?php echo set_value('duration') ?>">
                                 <span class="ar-danger"> <?php echo form_error('duration') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <div class="col-sm-offset-2 col-sm-10">
                                 <button type="submit" class="btn btn-success">Save</button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
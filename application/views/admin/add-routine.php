     <!-- tabs start-->
     <div class="admintab-area mg-b-15">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                     <div class="tab-content-details shadow-reset">
                         <h2>Add Class Routine</h2>
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
                     <form class="form-horizontal" action="<?php echo base_url('dashboard/add-routine/check') ?>" method="POST">
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
                             <label for="start_time" class="col-sm-2 control-label">Class Start Time</label>
                             <div class="col-sm-10">
                                 <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo set_value('start_time') ?>">
                                 <span class="ar-danger"> <?php echo form_error('start_time') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="end_time" class="col-sm-2 control-label">Class End Time</label>
                             <div class="col-sm-10">
                                 <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo set_value('end_time') ?>">
                                 <span class="ar-danger"> <?php echo form_error('end_time') ?></span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">Teacher</label>
                             <div class="col-sm-10">
                                 <select name="teacher" id="teacher" class="form-control class">
                                     <option value="" disabled selected>Select Teacher</option>
                                     <?php
                                        foreach ($teacher as $cl) {
                                        ?>
                                         <option value="<?php echo $cl->id ?>" <?php echo  set_select('teacher', $cl->id, false); ?>><?php echo $cl->name . '  (' . $cl->sname . ')' ?></option>
                                     <?php } ?>
                                 </select>
                                 <span class="ar-danger"> <?php echo form_error('teacher') ?></span>
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
                             <div class="col-sm-offset-2 col-sm-10">
                                 <button type="submit" class="btn btn-success">Save</button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
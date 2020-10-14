     <!-- tabs start-->
     <div class="admintab-area mg-b-15">
     	<div class="container-fluid">
     		<div class="row">
     			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
     				<div class="tab-content-details shadow-reset">
     					<h2>Admission Setting</h2>
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
     				<ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1 tab-menu-right">
     					<li class="active"><a data-toggle="tab" href="#SetupList"><span class="edu-icon edu-analytics tab-custon-ic"></span>Setup List</a>
     					</li>
     					<li><a data-toggle="tab" href="#NewSetup"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>New Setup</a>
     					</li>
     					<li><a data-toggle="tab" href="#TabPlan2"><span class="edu-icon edu-analytics-bridge tab-custon-ic"></span>Tab Plan</a>
     					</li>
     				</ul>
     				<div class="tab-content mg-t-15">
     					<div id="SetupList" class="tab-pane in active">
     						<table id="mydataTable" class="table table-bordered table-hover table-striped display" style="width:100%">
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
     							<tbody id="atbody">
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
												$status = "<td class='alert-success'><b>Active</b></dt>";
											} elseif ($intervalFromEnd->format('%R%a%h%i%s') < 0 && $startEnd->format('%R%a%h%i%s') > 0) {
												$status = "<td class='alert-danger'><b>Expired</b></dt>";
											} else {
												$status = "<td class='alert-warning'><b>Wrong Date</b></dt>";
											}
										?>
     									<tr>
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
     					<div id="NewSetup" class="tab-pane">
     						<form class="form-horizontal" action="<?php echo base_url('dashboard/admission-setup-save') ?>" method="POST">
     							<div class="form-group">
     								<label class="col-sm-2 control-label">Class</label>
     								<div class="col-sm-10">
										 <?php 
										 	foreach($class as $cl){
										 ?>
     									<label class="checkbox-inline">
     										<input type="checkbox" name="class[]" value="<?php echo $cl->id ?>" <?php echo set_checkbox('class[]', "{$cl->id}", false); ?>> <?php echo $cl->name ?>
										 </label>
											 <?php } ?>
     									<span class="ar-danger"> <?php echo form_error('class') ?></span>
     								</div>
     							</div>
     							<div class="form-group">
     								<label for="start_date" class="col-sm-2 control-label">Application Start Date</label>
     								<div class="col-sm-10">
     									<input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo set_value('start_date') ?>">
     									<span class="ar-danger"> <?php echo form_error('start_date') ?></span>
     								</div>
     							</div>
     							<div class="form-group">
     								<label for="end_date" class="col-sm-2 control-label">Application End Date</label>
     								<div class="col-sm-10">
     									<input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo set_value('end_date') ?>">
     									<span class="ar-danger"> <?php echo form_error('end_date') ?></span>
     								</div>
     							</div>
     							<div class="form-group">
     								<label class="col-sm-2 control-label">Exam Type</label>
     								<div class="col-sm-10">
     									<label class="checkbox-inline">
     										<input type="checkbox" name="exam_type[]" value="written" <?php echo set_checkbox('exam_type[]', 'written', false); ?>> Written
     									</label>
     									<label class="checkbox-inline">
     										<input type="checkbox" name="exam_type[]" value="viva" <?php echo set_checkbox('exam_type[]', 'viva', false); ?>> Viva
     									</label>
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
     								<label for="total_marks" class="col-sm-2 control-label">Total Marks</label>
     								<div class="col-sm-10">
     									<input type="number" class="form-control" id="total_marks" name="total_marks" placeholder="Total Marks Of Admission Exam." value="<?php echo set_value('total_marks') ?>">
     								</div>
     							</div>
     							<div class="form-group">
     								<label for="pass_marks" class="col-sm-2 control-label">Pass Marks</label>
     								<div class="col-sm-10">
     									<input type="number" class="form-control" id="pass_marks" name="pass_marks" placeholder="Pass Marks Of Admission Exam." value="<?php echo set_value('pass_marks') ?>">
     								</div>
     							</div>
     							<div class="form-group">
     								<div class="col-sm-offset-2 col-sm-10">
     									<button type="submit" class="btn btn-success">Save</button>
     								</div>
     							</div>
     						</form>
     					</div>
     					<div id="TabPlan2" class="tab-pane">
     						<p>23 34 4Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
     						<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. </p>
     						<p>the leap into electronic typesetting, remaining essentially unchanged.</p>
     					</div>
     				</div>
     			</div>
     		</div>
     	</div>
     </div>

     <!-- tabs start-->
     <div class="admintab-area mg-b-15">
     	<div class="container-fluid">
     		<div class="row">
     			<div class="row">
     				<div class="col-md-12 text-center page-header mt-b-30">
     					<h1>Students Result List</h1>
     				</div>
     				<?php
						$msg = $this->session->flashdata('msg');
						if (isset($msg) && $msg) {
							echo "<span class='alert-success' align='center'><p>$msg</p></span><br>";
						}
						?>
     			</div>
     		</div>
     		<div class="row">
     			<div class="col-md-12" id="a-info">
     				<div id="aSearch" class="form-inline col-md-12 mt-10 p-0">
     					<label for="mySearch" class="col-md-4 form-control">Search Student : </label>
     					<input id="mySearch" type="text" placeholder="Search..." class="col-md-8 form-control">
     				</div>
     				<div class="table-responsive col-md-12 p-0">
     					<table id="mydataTable" class="table table-bordered table-hover table-striped display mydataTable">
     						<thead>
     							<tr class="info">
     								<th>ID</th>
     								<th>Class</th>
     								<th>Section</th>
     								<th>Subject</th>
     								<th>Teacher</th>
     								<th>Exam Type</th>
     								<th>Exam Date</th>
     								<th>Start Time</th>
     								<th>Duration</th>
     								<th>Action</th>
     							</tr>
     						</thead>
     						<tbody id="atbody" class="atbody">
     							<?php
									foreach ($exam as $v) {
										// $date = new DateTime($v->date . $v->time);
										// $now = new DateTime();
										// $interval = $now->diff($date)->format("%R%d days, %h hours and %i minuts");
										// $disabled = '';
										// if ($interval > 0) {
										// 	$disabled = 'disabled';
										// }
									?>
     								<tr>
     									<td><?php echo $v->id ?></td>
     									<td><?php echo $v->cname ?></td>
     									<td><?php echo $v->sec_name ?></td>
     									<td><?php echo $v->sub_name ?></td>
     									<td><?php echo $v->tname ?></td>
     									<td><?php echo $v->etname ?></td>
     									<td><?php echo $v->date ?></td>
     									<td><?php echo $v->time ?></td>
     									<td><?php echo $v->duration ?></td>
     									<td><button class="btn btn-block btn-success marksViewBtn" value="<?php echo $v->id ?>">View Marks</button></td>
     								</tr>

     							<?php } ?>
     						</tbody>
     					</table>
     				</div>
     				<div class="col-md-12 p-0 d-none" id="errorMsg">
     				</div>
     			</div>
     			<div class="col-md-12 d-none" id="marksView">
     				<div class="form-inline col-md-12 mt-10 p-0 aSearch">
     					<label for="mySearch" class="col-md-4 form-control">Search Student : </label>
     					<input id="mvSearch" type="text" placeholder="Search..." class="col-md-8 form-control mySearch">
     				</div>
     				<div class="table-responsive col-md-12 p-0">
     						<table class="table table-bordered table-hover table-striped display marksViewTable">
     							<thead>
     								<tr class="info">
     									<th>ID</th>
     									<th>Class</th>
     									<th>Section</th>
     									<th>Subject</th>
     									<th>Students</th>
     									<th>Gender</th>
     									<th>Exam Type</th>
     									<th>Exam Date</th>
     									<th>Marks</th>
     								</tr>
     							</thead>
     							<tbody id="mvtbody" class="mvtbody">
     							</tbody>
     						</table>
     						<a href="<?php echo base_url('dashboard/result') ?>" class="btn btn-primary alignright">Back</a>
     				</div>
     			</div>
     		</div>
     	</div>
     </div>

     <!-- Modal -->
     <div class="modal fade myModel" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     	<div class="modal-dialog" role="document">
     		<div class="modal-content">
     			<div class="modal-header">
     				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     				<h4 class="modal-title" id="myModalLabel">Applicant Information</h4>
     			</div>
     			<div class="modal-body" id="studentInfo">

     			</div>
     			<div class="modal-footer">
     				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
     				<!-- <form action="<?php //echo base_url('admin/applicant-confirm') 
										?>" method="POST">
     					<button type="submit" class="btn btn-primary" id="apConfirm" name="apConfirm">Confirm</button>
     				</form> -->
     			</div>
     		</div>
     	</div>
     </div>
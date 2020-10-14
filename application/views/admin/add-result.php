     <!-- tabs start-->
     <div class="admintab-area mg-b-15">
     	<div class="container-fluid">
     		<div class="row">
     			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     				<div class="tab-content-details shadow-reset text-left">
     					<div class="row">
     						<div class="col-md-12 text-center page-header mt-b-30">
     							<h1>Add Exam Result </h1>
     						</div>
     						<?php
								$msg = $this->session->flashdata('msg');
								if (isset($msg) && $msg) {
									echo "<span class='alert-success' align='center'><p>$msg</p></span><br>";
								}
								?>
     						<div class="col-md-4 mt-4" id="">
     							<label for="class">Select Class</label>
     							<select name="class" id="class" class="form-control class">
     								<option disabled selected>Select Class</option>
     								<?php
										foreach ($class as $c) {
											echo "<option value=" . $c->id . ">" . $c->name . "</option>";
										}
										?>
     							</select>
     						</div>
     						<div class="col-md-4">
     							<label for="section">Select Section</label>
     							<select name="section" id="section" class="form-control section">
     								<option disabled selected>Select Class First</option>
     							</select>
     						</div>
     						<div class="col-md-4">
     							<label for="exam">Exam</label>
     							<select name="exam" id="exam" class="form-control exam">
     								<option disabled selected>Select Section First</option>
     							</select>
     						</div>
     					</div>
     				</div>
     			</div>
     		</div>
     		<div class="row">
     			<div class="col-md-12" id="a-info">
     				<div id="aSearch" class="form-inline col-md-12 mt-10 p-0" style="display: none; width:100%">
     					<label for="mySearch" class="col-md-4 form-control">Search Student : </label>
     					<input id="mySearch" type="text" placeholder="Search.." class="col-md-8 form-control">
     				</div>
     				<div class="table-responsive col-md-12 p-0">
     					<form action="">
     						<table id="mydataTable" class="table table-bordered table-hover table-striped display mydataTable" style="display: none; width:100%">
     							<thead>
     								<tr class="info">
     									<th>ID</th>
     									<th>Name</th>
     									<th>Class</th>
     									<th>Section</th>
     									<th>Gender</th>
     									<th>Mark</th>
     								</tr>
     							</thead>
     							<tbody id="atbody" class="atbody">
     							</tbody>
     						</table>
     						<button type="submit" class="btn btn-success alignright d-none saveBtn">Save</button>
     					</form>
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
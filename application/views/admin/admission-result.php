     <!-- tabs start-->
     <div class="admintab-area mg-b-15">
     	<div class="container-fluid">
     		<div class="row">
     			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
     				<div class="tab-content-details shadow-reset">
     					<h2>Admission Result</h2>
     					<p>Add Application Start Data and End Date, Exam Date or viva Date, How to evaluated in Admission Exam.</p>
     				</div>
				 </div>
				 <span class='ar-success' id="msg" align='center'></span><br>
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
     					<li class="active"><a data-toggle="tab" href="#SetupList"><span class="edu-icon edu-analytics tab-custon-ic"></span>View Result</a>
     					</li>
     					<li><a data-toggle="tab" href="#NewSetup"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>Input Result</a>
     					</li>
     					<li><a data-toggle="tab" href="#TabPlan2"><span class="edu-icon edu-analytics-bridge tab-custon-ic"></span>Tab Plan</a>
     					</li>
     				</ul>
     				<div class="tab-content mg-t-15">
     					<div id="SetupList" class="tab-pane in active">
     						<div class="row mg-b-15">
     							<div class="col-md-6 mt-4" id="">
     								<label for="class">Select Class</label>
     								<select name="class" class="form-control class">
     									<option>Select Class</option>
     									<?php
											foreach ($class as $c) {
												echo "<option value=" . $c->id . ">" . $c->name . "</option>";
											}
											?>
     								</select>
     							</div>
     							<div class="col-md-6">
     								<label for="section">Select Section</label>
     								<select name="section" class="form-control section">
     									<option>Select Class First</option>
     								</select>
     							</div>
     						</div>
     						<table class="table table-bordered table-hover table-striped display mydataTable" style="width:100%">
     							<thead>
     								<tr class="info">
     									<th>ID</th>
     									<th>Name</th>
     									<th>Marks</th>
     									<th>Result</th>
     									<th>Action</th>
     								</tr>
     							</thead>
     							<tbody class="atbody">
     							</tbody>
     						</table>
     					</div>
     					<div id="NewSetup" class="tab-pane">
     						<div class="row mg-b-15">
     							<div class="col-md-6 mt-4" id="">
     								<label for="class">Select Class</label>
     								<select name="class" class="form-control class">
     									<option>Select Class</option>
     									<?php
											foreach ($class as $c) {
												echo "<option value=" . $c->id . ">" . $c->name . "</option>";
											}
											?>
     								</select>
     							</div>
     							<div class="col-md-6">
     								<label for="section">Select Section</label>
     								<select name="section" class="form-control section inputSection">
     									<option>Select Class First</option>
     								</select>
     							</div>
     						</div>
     						<form class="form-horizontal" action="<?php echo base_url('dashboard/admission-result-save') ?>" method="POST">
     							<table class="table table-bordered table-hover table-striped display inputTable" style="width:100%">
     								<thead>
     									<tr class="info">
     										<th>ID</th>
     										<th>Name</th>
     										<th>Marks</th>
     									</tr>
     								</thead>
     								<tbody class="itbody">
     								</tbody>
     							</table>
     							<button type="submit" class="btn btn-success alignright">Save</button>
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
     <!-- Modal -->
     <div class="modal fade myModel" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     	<div class="modal-dialog" role="document">
     		<div class="modal-content">
     			<div class="modal-header">
     				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     				<h4 class="modal-title" id="myModalLabel">Applicant Information</h4>
     			</div>
     			<div class="modal-body" id="apInfo">
     			</div>
     			<div class="modal-footer">
     				<button type="button" class="btn btn-warning close-button" data-dismiss="modal">Close</button>
     				<button type="submit" class="btn btn-success" id="apConfirm" name="apConfirm">Confirm</button>
     				<button type="submit" class="btn btn-danger" id="apDelete" name="apDelete">Delete</button>
     			</div>
     		</div>
     	</div>
     </div>

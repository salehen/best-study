     <!-- tabs start-->
     <div class="admintab-area mg-b-15">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                     <div class="tab-content-details shadow-reset text-left">
                         <div class="row">
                             <div class="col-md-12 text-center page-header mt-b-30">
                                 <h1>Exam Schedule List</h1>
                             </div>
                             <?php
                                $msg = $this->session->flashdata('msg');
                                if (isset($msg) && $msg) {
                                    echo "<span class='alert-success' align='center'><p style='color: green'>$msg</p></span><br>";
                                }
                                ?>
                             <div class="col-md-6 mt-4" id="">
                                 <label for="class">Select Class</label>
                                 <select name="class" id="class" class="form-control">
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
                                 <select name="section" id="section" class="form-control">
                                     <option>Select Class First</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12" id="a-info">
                     <div id="aSearch" class="form-inline col-md-12 mt-10 p-0" style="display: none; width:100%">
                         <label for="mySearch" class="col-md-4 form-control">Search : </label>
                         <input id="mySearch" type="text" placeholder="Search.." class="col-md-8 form-control">
                     </div>
                     <div class="table-responsive col-md-12 p-0">
                         <table id="mydataTable" class="table table-bordered table-hover table-striped display" style="display: none; width:100%">
                             <thead>
                                 <tr class="info">
                                     <th>ID</th>
                                     <th>Class</th>
                                     <th>Section</th>
                                     <th>Subject</th>
                                     <th>Exam Type</th>
                                     <th>Exam Date</th>
                                     <th>Start Time</th>
                                     <th>Duration</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody id="atbody">
                             </tbody>
                         </table>
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
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <!-- <form action="<?php //echo base_url('admin/applicant-confirm') 
                                        ?>" method="POST">
     					<button type="submit" class="btn btn-primary" id="apConfirm" name="apConfirm">Confirm</button>
     				</form> -->
                 </div>
             </div>
         </div>
     </div>
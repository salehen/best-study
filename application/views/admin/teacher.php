<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap drp-lst">
                    <h4>Teacher List</h4>
                    <?php
						$msg = $this->session->flashdata('msg');
						if (isset($msg) && $msg) {
							echo "<span class='alert-success' align='center'><p>$msg</p></span><br>";
						}
						?>
                    <div class="add-product">
                        <a href="<?php echo base_url('dashboard/add-teacher') ?>">Add Teacher</a>

                        <div id="aSearch" class="form-inline col-md-8 mt-10 p-0">
                            <label for="mySearch" class="col-md-4 form-control">Search Teacher : </label>
                            <input id="mySearch" type="text" placeholder="Search.." class="col-md-8 form-control">
                        </div>
                    </div>
                    <div class="asset-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Designation</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Employee ID</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php
                                if ($teacher) {
                                    $sl = 1;
                                    foreach ($teacher as $cl) {
                                ?>
                                        <tr>
                                            <td><?php echo $sl ?></td>
                                            <td><?php echo $cl->name ?></td>
                                            <td><?php echo $cl->sname ?></td>
                                            <td><?php echo $cl->designation ?></td>
                                            <td><?php echo $cl->email ?></td>
                                            <td><?php echo $cl->mobile ?></td>
                                            <td><?php echo $cl->employee_id ?></td>
                                            <td>
                                                <button data-toggle="modal" data-target=".myModel" title="Edit" class="pd-setting-ed section btn-info" value="<?php echo $cl->id ?>" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="modal" data-target=".myModel" title="Trash" class="pd-setting-ed section btn-danger" value="<?php echo $cl->id ?>" name="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                <?php
                                        $sl++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
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
                <h4 class="modal-title" id="myModalLabel">Class Information</h4>
            </div>
            <div class="modal-body" id="studentInfo">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning close-button" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success modalBtn" id="saveBtn" name="saveBtn">Save</button>
                <button type="submit" class="btn btn-danger modalBtn" id="deleteBtn" name="deleteBtn">Delete</button>
                <!-- <form action="<?php //echo base_url('admin/applicant-confirm') 
                                    ?>" method="POST">
     					<button type="submit" class="btn btn-primary" id="apConfirm" name="apConfirm">Confirm</button>
     				</form> -->
            </div>
        </div>
    </div>
</div>
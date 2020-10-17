$("document").ready(function () {
    
    $(".mySearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#iftbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $("#mvSearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#mvtbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('body').on('click', '.marksInput', function (e) {
        e.preventDefault();
        var examID = Number($(this).val());
        console.log(examID);
        if (examID) {
            $.ajax({
                type: "post",
                url: $("meta[name='url']").attr("content") + "admin/api/exam-mark-input",
                data: {
                    'examID': examID
                },
                success: function (response) {
                    // console.log(response);
                    if (response) {
                        response = JSON.parse(response);
                        rtl = "";
                        $(".mofiz").remove();
                        $(".no-data").remove();
                        for (var index in response) {
                            if (response[index]['gender'] == 1) {
                                gender = 'Male';
                            } else if (response[index]['gender'] == 2) {
                                gender = 'Female';
                            } else {
                                gender = 'Other';
                            }
                            rtl += "<tr class='mofiz' salehen='" + response[index]['sid'] + "'>";
                            rtl += "<td>" + response[index]['sid'] + "</td>";
                            rtl += "<td>" + response[index]['cname'] + "</td>";
                            rtl += "<td>" + response[index]['sec_name'] + "</td>";
                            rtl += "<td>" + response[index]['sub_name'] + "</td>";
                            rtl += "<td>" + response[index]['sname'] + "</td>";
                            rtl += "<td>" + gender + "</td>";
                            rtl += "<td>" + response[index]['etname'] + "</td>";
                            rtl += "<td>" + response[index]['date'] + "</td>";
                            rtl += `<td>
                                        <input type="number" name="marks[]" class="form-control" >
                                        <input type="hidden" name="studentID[]" value="`+ response[index]['sid'] + `"> 
                                        <input type="hidden" name="examID" value="`+ response[index]['id'] + `"> 
                                        <input type="hidden" name="status" value="`+ response[index]['status'] + `"> 
									</td>`;
                            rtl += "</tr>";
                        }
                        $('#a-info').hide();
                        $('#inputForm').show();
                        $("#iftbody").append(rtl);
                    } else {
                        $('#errorMsg').show();
                        $(".mofiz").remove();
                        $(".no-data").remove();
                        $("#errorMsg").append("<p class='alert-success text-center no-data'><b>No Student Found</b></p>");
                    }
                }
            });
        } else {
            $('#errorMsg').show();
            $(".mofiz").remove();
            $(".no-data").remove();
            $("#errorMsg").append("<p class='alert-success text-center no-data'><b>No Student Found</b></p>");
        }
    })


    $('body').on('click', '.marksViewBtn', function (e) {
        e.preventDefault();
        var examID = Number($(this).val());
        console.log(examID);
        if (examID) {
            $.ajax({
                type: "post",
                url: $("meta[name='url']").attr("content") + "admin/api/exam-mark-view",
                data: {
                    'examID': examID
                },
                success: function (response) {
                    // console.log(response);
                    if (response) {
                        response = JSON.parse(response);
                        rtl = "";
                        $(".mofiz").remove();
                        $(".no-data").remove();
                        for (var index in response) {
                            if (response[index]['gender'] == 1) {
                                gender = 'Male';
                            } else if (response[index]['gender'] == 2) {
                                gender = 'Female';
                            } else {
                                gender = 'Other';
                            }
                            rtl += "<tr class='mofiz' salehen='" + response[index]['sid'] + "'>";
                            rtl += "<td>" + response[index]['sid'] + "</td>";
                            rtl += "<td>" + response[index]['sname'] + "</td>";
                            rtl += "<td>" + response[index]['cname'] + "</td>";
                            rtl += "<td>" + response[index]['sec_name'] + "</td>";
                            rtl += "<td>" + response[index]['sub_name'] + "</td>";                            
                            rtl += "<td>" + gender + "</td>";
                            rtl += "<td>" + response[index]['etname'] + "</td>";
                            rtl += "<td>" + response[index]['date'] + "</td>";
                            rtl += "<td>" + response[index]['marks'] + "</td>";
                            rtl += "</tr>";
                        }
                        $('#a-info').hide();
                        $('#marksView').show();
                        $("#mvtbody").append(rtl);
                    } else {
                        $('#errorMsg').show();
                        $(".mofiz").remove();
                        $(".no-data").remove();
                        $("#errorMsg").append("<p class='alert-success text-center no-data'><b>No Student Found</b></p>");
                    }
                }
            });
        } else {
            $('#errorMsg').show();
            $(".mofiz").remove();
            $(".no-data").remove();
            $("#errorMsg").append("<p class='alert-success text-center no-data'><b>No Student Found</b></p>");
        }
    })




    $("#section").change(function () {
        var classID = Number($(this).val());
        alert(classID)
        if (classID) {
            $.ajax({
                type: "post",
                url: $("meta[name='url']").attr("content") + "admin/api/load-exam",
                data: {
                    "sid": classID
                },
                success: function (data) {
                    //console.log(data)
                    $("#exam").html('<option disabled selected>Select Exam</option>' + data)
                }
            });
        } else {
            $("#exam").html('<option>Select Section First</option>')
        }
    });

    $("#class").change(function () {
        $('#a-info').hide();
    })

    $("#section").change(function () {
        $('#mySearch').val('');
        var secID = parseInt($(this).val());
        // alert(secID)
        if (secID) {
            $.ajax({
                type: "post",
                url: $("meta[name='url']").attr("content") + "admin/api/student-list",
                data: {
                    'sid': secID
                },
                success: function (response) {
                    // console.log(response);
                    if (response) {
                        response = JSON.parse(response);
                        rtl = "";
                        $(".mofiz").remove();
                        $(".no-data").remove();
                        for (var index in response) {
                            if (response[index]['gender'] == 1) {
                                gender = 'Male';
                            } else if (response[index]['gender'] == 2) {
                                gender = 'Female';
                            } else {
                                gender = 'Other';
                            }
                            rtl += "<tr class='mofiz' salehen='" + response[index]['id'] + "'>";
                            rtl += "<td>" + response[index]['id'] + "</td>";
                            rtl += "<td>" + response[index]['name'] + "</td>";
                            rtl += "<td>" + response[index]['cname'] + "</td>";
                            rtl += "<td>" + response[index]['sname'] + "</td>";
                            rtl += "<td>" + gender + "</td>";
                            rtl += `<td>
                                        <input type="text" name="marks[]" class="form-control" >
                                        <input type="hidden" name="id[]" value="`+ response[index]['id'] + `"> 
									</td>`;
                            rtl += "</tr>";
                        }
                        $('#a-info').show();
                        $("#aSearch").show();
                        $("#mydataTable").show();
                        $(".saveBtn").show();
                        $("#atbody").append(rtl);
                    } else {
                        $('#a-info').show();
                        $("#aSearch").hide();
                        $("#mydataTable").hide();
                        $(".saveBtn").hide();
                        $(".mofiz").remove();
                        $(".no-data").remove();
                        $("#a-info").append("<p class='alert-success text-center no-data'><b>No Data Found</b></p>");
                    }
                }
            });
        } else {
            $('#a-info').show();
            $("#aSearch").hide();
            $("#mydataTable").hide();
            $(".saveBtn").hide();
            $(".mofiz").remove();
            $(".no-data").remove();
            $("#a-info").append("<p class='alert-success text-center no-data'><b>No Data Found</b></p>");
        }
    });

    $("#mySearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#atbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //data table
    // $('#mydataTable').DataTable();

    $("body").on("click", ".app-btn", function (e) {
        e.preventDefault();
        var id = parseInt($(this).val());
        if (id) {
            $.ajax({
                type: "post",
                url: $("meta[name='url']").attr("content") + "admin/api/applicant-info",
                data: {
                    'aid': id
                },
                success: function (response) {
                    if (response) {
                        response = JSON.parse(response);
                        html = '';
                        $(".apDet").remove();
                        for (var index in response) {
                            if (response[index]['gender'] == 1) {
                                gender = 'Male';
                            } else if (response[index]['gender'] == 2) {
                                gender = 'Female';
                            } else {
                                gender = 'Other';
                            }

                            if ((response[index]['picture']) != '') {
                                var img = `<img src="` + $("meta[name='url']").attr("content") + `assets/images/admission/` + response[index]['id'] + `_org.` + response[index]['picture'] + `" alt="No Picture" width="150">
								`
                            } else {
                                var img = `<img src="` + $("meta[name='url']").attr("content") + `assets/images/no-image.png` + `" alt="No Picture" width="150">
								`
                            }

                            html = `
								<div class="fields-grid apDet">
									<div class="col-md-8">
										<div class="styled-input">
											<label>Student Name :</label>
											<input type="text" placeholder="Your Name" name="name" required="" value="`+ response[index]['name'] + `" readonly>
										</div>
										<div class="styled-input">
											<label>Father Name :</label>
											<input type="text" placeholder="Father Name" name="fa_name" required="" value="`+ response[index]['father_name'] + `" readonly>
										</div>
										<div class="styled-input">
											<label>Mother Name :</label>
											<input type="text" placeholder="Mother Name" name="mo_name" required="" value="`+ response[index]['mother_name'] + `" readonly>
										</div>
										<div class="styled-input">
											<label>Birth Date :</label>
											<input id="datepicker" placeholder="Birth Date" name="bi_date" type="text" value="`+ response[index]['birth_date'] + `" readonly>
										</div>
										<div class="styled-input agile-styled-input-top">
											<label>Gender :</label>
											<input type="text" name="gender" required="" value="`+ gender + `" readonly>
										</div>
										<div class="styled-input">
											<label>E-mail :</label>
											<input type="email" placeholder="Your E-mail" name="email" required="" value="`+ response[index]['email'] + `" readonly>
										</div>
										<div class="styled-input">
											<label>Phone Number :</label>
											<input type="text" placeholder="Phone Number" name="phone" required="" value="`+ response[index]['phone'] + `" readonly>
										</div>
										<div class="styled-input agile-styled-input-top">
											<label>Class :</label>
											<input type="text" placeholder="Phone Number" name="phone" required="" value="`+ response[index]['cname'] + `" readonly>
											<span></span>
										</div>
										<div class="styled-input">
											<label>Section :</label>
											<input type="text" placeholder="Phone Number" name="phone" required="" value="`+ response[index]['sname'] + `" readonly>
										</div>
										<div class="styled-input">
											<label>Nationality :</label>
											<input type="text" placeholder="Nationality" name="nationality" required="" value="`+ response[index]['nationality'] + `" readonly>
										</div>
										
										<div class="styled-input">
											<label class="header">Student Address</label>
											<div class="">
												<label>Address :</label>
												<textarea rows="4" cols="21">`+ response[index]['address'] + `</textarea>
											</div>
											<div class="">
												<label for="">Country</label>
												<input type="text" name="country" placeholder="Country" title="Please enter your Country" required="" value="`+ response[index]['country'] + `" readonly>
											</div>
											<div class="">
												<label for="">City</label>
												<input type="text" name="city" placeholder="City" title="Please enter your City" required="" value="`+ response[index]['city'] + `" readonly>
											</div>
											<div class="">
												<label for="">Post Code</label>
												<input type="text" name="post_code" placeholder="Post Code" title="Please enter your Post code" required="" value="`+ response[index]['post_code'] + `" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-4>
										<div class="">
										`+ img + `
											
										</div>
									</div>
								</div>
								<div class="clearfix"> </div>
							`;
                            id = response[index]['id'];
                        };
                        $("#apInfo").append(html);
                        $("#apConfirm").val(id);
                        $("#apDelete").val(id);
                    }
                }
            });
        }
        var bn = $(this).attr('name');
        if (bn == 'approve') {
            $("#apDelete").hide();
            $("#apConfirm").show();
        } else {
            $("#apConfirm").hide();
            $("#apDelete").show();
        }
    });

    $("body").on("click", "#apConfirm", function (e) {
        e.preventDefault();
        var id = parseInt($(this).val());
        if (id) {
            $.ajax({
                type: "post",
                url: $("meta[name='url']").attr("content") + "admin/api/applicant-confirm",
                data: {
                    'aid': id
                },
                success: function (response) {
                    $('#msg p').remove();
                    if (response) {
                        $("#msg").append("<p class='alert-success text-center no-data'><b>" + response + "</b></p>");
                        $('#myModal').modal('hide');
                        $(`tr[salehen="${id}"]`).remove();
                    }
                }
            });
        }
    });

    $("body").on("click", "#apDelete", function (e) {
        e.preventDefault();
        var id = parseInt($(this).val());
        if (id) {
            $.ajax({
                type: "post",
                url: $("meta[name='url']").attr("content") + "admin/api/applicant-delete",
                data: {
                    'aid': id
                },
                success: function (response) {
                    $('#msg p').remove();
                    if (response) {
                        $("#msg").append("<p class='alert-danger text-center no-data'><b>" + response + "</b></p>");
                        $('#myModal').modal('hide');
                        $(`tr[salehen="${id}"]`).remove();
                    }
                }
            });
        }
    });


});

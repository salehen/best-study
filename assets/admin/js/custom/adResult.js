$("document").ready(function () {

	$(".class").change(function () {
		var classID = Number($(this).val());
		// alert(classID)
		if (classID) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "api/load-section",
				data: {
					"cID": classID
				},
				success: function (data) {
					// console.log(data)
					$(".section").html('<option>Select section</option>' + data)
				}
			});
		} else {
			$(".section").html('<option>Select Class First</option>')
		}
	});


	$(".section").change(function () {
		var secID = parseInt($(this).val());
		// alert(secID)
		if (secID) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "admin/api/adConfirm-list",
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
							if (response[index]['marks'] >= response[index]['pmark']) {
								result = `<td class='bg-success text-success text-center'><b>Pass</b></td>
								<td>
								<button type="button" class="btn btn-primary appli-ap view" value="`+ response[index]['id'] + `" data-toggle="modal" data-target=".myModel">View</button>
								<button type="button" class="btn btn-success appli-ap admitted" name='approve' disable value="`+ response[index]['id'] + `" data-toggle="modal" data-target=".myModel">Admitted</button>
							</td>
								`;
							} else {
								result = `<td class='bg-danger text-danger text-center'><b>Fail</b></td>
								<td>
								<button type="button" class="btn btn-primary appli-ap" value="`+ response[index]['id'] + `" data-toggle="modal" data-target=".myModel">View</button>
								<button type="button" class="btn btn-success appli-ap" disabled value="`+ response[index]['id'] + `" data-toggle="modal" data-target=".myModel">Admitted</button>
							</td>
								`;
							}
							rtl += "<tr class='mofiz' salehen=" + response[index]['id'] + ">";
							rtl += "<td>" + response[index]['id'] + "</td>";
							rtl += "<td>" + response[index]['name'] + "</td>";
							rtl += "<td>" + response[index]['marks'] + "</td>";
							rtl += result;
							rtl += "</tr>";
						}
						$('#a-info').show();
						$("#aSearch").show();
						$(".mydataTable").show();
						$(".atbody").append(rtl);
					} else {
						$('#a-info').show();
						$("#aSearch").hide();
						$(".mydataTable").hide();
						$(".mofiz").remove();
						$(".no-data").remove();
						$("#a-info").append("<p class='alert-success text-center no-data'><b>No Data Found</b></p>");
					}
				}
			});
		} else {
			$('#a-info').show();
			$("#aSearch").hide();
			$(".mydataTable").hide();
			$(".mofiz").remove();
			$(".no-data").remove();
			$("#a-info").append("<p class='alert-success text-center no-data'><b>No Data Found</b></p>");
		}
	});

	$(".inputSection").change(function () {
		var secID = parseInt($(this).val());
		// alert(secID)
		if (secID) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "admin/api/adConfirm-list",
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
							rtl += "<tr class='mofiz'>";
							rtl += "<td>" + response[index]['id'] + "</td>";
							rtl += "<td>" + response[index]['name'] + "</td>";
							rtl += "<td><input type='hidden' name='id[]' value='" + response[index]['id'] + "'><input type='number' name='marks[]' class='form-control' value='" + response[index]['marks'] + "'></td>";
							rtl += "</tr>";
						}
						$('#a-info').show();
						$("#aSearch").show();
						$(".inputTable").show();
						$(".itbody").append(rtl);
					} else {
						$('#a-info').show();
						$("#aSearch").hide();
						$(".inputTable").hide();
						$(".mofiz").remove();
						$(".no-data").remove();
						$("#a-info").append("<p class='alert-success text-center no-data'><b>No Data Found</b></p>");
					}
				}
			});
		} else {
			$('#a-info').show();
			$("#aSearch").hide();
			$(".inputTable").hide();
			$(".mofiz").remove();
			$(".no-data").remove();
			$("#a-info").append("<p class='alert-success text-center no-data'><b>No Data Found</b></p>");
		}
	});

	$("#mySearch").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$(".atbody tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	//data table
	// $('#mydataTable').DataTable();

	$("body").on("click", ".appli-ap", function (e) {
		e.preventDefault();
		var id = parseInt($(this).val());
		if (id) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "admin/api/app-confirm-info",
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
			$("#apDelete").hide();
		}
	})


	$("body").on("click", "#apConfirm", function (e) {
		e.preventDefault();
		var id = parseInt($(this).val());
		if (id) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "admin/api/admitted-confirm",
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

	// $("body").on("click", "#apConfirm", function (e) {
	// 	e.preventDefault();
	// 	var id = parseInt($(this).val());
	// 	if (id) {
	// 		$.ajax({
	// 			type: "post",
	// 			url: $("meta[name='url']").attr("content") + "admin/api/applicant-confirm",
	// 			data: {
	// 				'aid': id
	// 			},
	// 			success: function (response) {
	// 				if (response) {
	// 					$("#msg").append("<p class='alert-success text-center no-data'><b>"+response+"</b></p>");
	// 					$('.close-button').Click();
	// 				}
	// 			}
	// 		});
	// 	}
	// })


})

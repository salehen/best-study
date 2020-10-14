$("document").ready(function () {
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
							rtl += "<td>" + response[index]['name'] + "</td>";
							rtl += "<td>" + response[index]['father_name'] + "</td>";
							rtl += "<td>" + response[index]['email'] + "</td>";
							rtl += "<td>" + response[index]['phone'] + "</td>";
							rtl += "<td>" + response[index]['city'] + "</td>";
							rtl += `<td>
										<button type="button" class="btn btn-primary appli-ap" value="`+ response[index]['id'] + `" data-toggle="modal" data-target=".myModel">View</button>
									</td>`;
							rtl += "</tr>";
						}
						$('#a-info').show();
						$("#aSearch").show();
						$("#mydataTable").show();
						$("#atbody").append(rtl);
					} else {
						$('#a-info').show();
						$("#aSearch").hide();
						$("#mydataTable").hide();
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
											<input type="text" name="gender" required="" value="`+ response[index]['gender'] + `" readonly>
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
											<input type="text" placeholder="Phone Number" name="phone" required="" value="`+ response[index]['class'] + `" readonly>
											<span></span>
										</div>
										<div class="styled-input">
											<label>Section :</label>
											<input type="text" placeholder="Phone Number" name="phone" required="" value="`+ response[index]['section_id'] + `" readonly>
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
											<img src="`+ $("meta[name='url']").attr("content") + `assets/images/admission/` + response[index]['id'] + `_org.` + response[index]['picture'] + `" alt="Picture" width="150">
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
	})

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

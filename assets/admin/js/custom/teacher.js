$("document").ready(function () {
    	// email check function
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(String(email).toLowerCase());
	}

	// check reg-email script
	$("input[name='email']").keyup(function () {
		var email = $(this).val();
		if (validateEmail(email)) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "admin/api/teacher-email-check",
				data: {
					'email': email
				},
				success: function (data) {
					$("#chackEmail").html(data)
				}
			});
		} else {
			$("#chackEmail").html("")
		}
	});

	$("#mySearch").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$(".tbody tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$("body").on("click", ".class", function (e) {
		e.preventDefault();
		var id = parseInt($(this).val());
		// console.log(id);
		if (id) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "admin/api/class-info",
				data: {
					'cid': id
				},
				success: function (response) {
					if (response) {
						response = JSON.parse(response);
						html = '';
						$(".apDet").remove();

						html += `
								<div class="fields-grid apDet">
									<div class="col-md-8">
										<div class="styled-input">
											<label>Class Title :</label>
											<input type="text" placeholder="Your Name" name="name" required="" value="`+ response[0]['name'] + `" readonly>
										</div><br>
										<div class="styled-input">
											<label>Total Section :</label>
											<input type="text" placeholder="Your Name" name="name" required="" value="`+ response[0]['totalSec'] + `" readonly>
										</div><br>`
						for (var index in response) {
							html += `<div class="styled-input">
											<label>Section :</label>
											<input type="text" placeholder="Father Name" name="fa_name" required="" value="`+ response[index]['sname'] + `" readonly>
										</div>
										<div class="styled-input">
											<label>Total Student :</label>
											<input type="text" placeholder="Mother Name" name="mo_name" required="" value="`+ response[index]['totalStudents'] + `" readonly>
										</div><br>`
						};
						html += `</div>
									<div class="col-md-4>
										<div class="">											
										</div>
									</div>
								</div>
								<div class="clearfix"> </div>
							`;
						$("#studentInfo").append(html);
						$(".modalBtn").val(id);
					} else {
						html = `
							<div class="fields-grid apDet">
								<div class='alert-danger'>
									<b>NO Student Found Under this Class.</b>
								</div>
							</div>`;
						$(".apDet").remove();
						$("#studentInfo").append(html);
						$(".modalBtn").val(id);
					}
				}
			});
		}
		var bn = $(this).attr('name');
		if (bn == 'edit') {
			$("#deleteBtn").hide();
			$("#saveBtn").show();
		} else {
			$("#deleteBtn").show();
			$("#saveBtn").hide();
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

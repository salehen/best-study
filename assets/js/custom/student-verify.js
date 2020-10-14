$("document").ready(function () {

	// email check function
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(String(email).toLowerCase());
	}

	// check gd-email script
	$("input[name='gEmail']").keyup(function () {
		ch = 0;
		if ($('#gar').is(":checked")) {
			ch = $("#gar").val();
		}
		var email = $(this).val();
		if (validateEmail(email)) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "api/gd-email-check",
				data: {
					'email': email,
					'ch': ch
				},
				success: function (data) {
					data = JSON.parse(data);
					if (ch == 1) {
						$(".gname").show();
						$(".gmobile").show();
						for (var index in data) {
							if (data[index]['name']) {
								$("input[name='gname']").val(data[index]['name']);
								$("input[name='gmobile']").val(data[index]['mobile']);
								$("#chackEmail").html("<p style='color:green'>Yes... Guardian Found.</p>");
							} else {
								$("input[name='gname']").val('');
								$("input[name='gmobile']").val('');
								$(".gname").hide();
								$(".gmobile").hide();
								$("#chackEmail").html(data);
							}
						}
					} else {
						$("#chackEmail").html(data);
					}
				}
			});
		} else {
			$("#chackEmail").html("<p>* Enter Valid E-mail.</p>");
		}
	});

	$('#gar').click(function () {
		ch = 0;
		if ($('#gar').is(":checked")) {
			ch = $("#gar").val();
		}
		if (ch == 1) {
			$(".gname").hide();
			$(".gmobile").hide();
			$("#chackEmail").html("");
			$("input[name='gEmail']").val('');
			$("input[name='gname']").val('');
			$("input[name='gmobile']").val('');
		} else {
			$(".gname").show();
			$(".gmobile").show();
			$("#chackEmail").html("");
			$("input[name='gEmail']").val('');
			$("input[name='gname']").val('');
			$("input[name='gmobile']").val('');
		}
	})



})

$("document").ready(function () {
	// check reg-email script
	$("#class").change(function () {
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
					//console.log(data)
					$("#section").html('<option disabled selected>Select section</option>'+data)
				}
			});
		} else {
			$("#section").html('<option>Select Class First</option>')
		}
	});


})

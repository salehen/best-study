$("document").ready(function () {
	$("body").on("click", ".apply_now", function (e) {
		e.preventDefault();
		var classID =$(this).attr('cid');
		// alert(classID);
		if (classID) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "api/load-section",
				data: {
					"cID": classID 
				},
				success: function (data) {
					//console.log(data)
					$("#section").html('<option>Select section</option>'+data)
				}
			});
		}
	})
	// check reg-email script
	$("#class").change(function () {
		var classID = Number($(this).val());
		alert(classID)
		if (classID) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "api/load-section",
				data: {
					"cID": classID 
				},
				success: function (data) {
					//console.log(data)
					$("#section").html('<option>Select section</option>'+data)
				}
			});
		} else {
			$("#section").html('<option>Select Class First</option>')
		}
	});


})

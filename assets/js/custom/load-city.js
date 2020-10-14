$("document").ready(function () {
	// check reg-email script
	$(".country").change(function () {
		var countryID = Number($(this).val());
		// alert(countryID)
		if (countryID) {
			$.ajax({
				type: "post",
				url: $("meta[name='url']").attr("content") + "api/load-city",
				data: {
					"cID": countryID
				},
				success: function (data) {
					// data = JSON.parse(data);
					//console.log(data)
					$(".city").html('<option>Select City</option>'+data)
				}
			});
		} else {
			$(".city").html('<option>Select Country First</option>')
		}
	});

	var selectedVal = $(".city option:selected").val();
	if(selectedVal){
		$.ajax({
			type: "post",
			url: $("meta[name='url']").attr("content") + "api/load-city-name",
			data: {
				"cID": selectedVal
			},
			success: function (data) {
				// data = JSON.parse(data);
				//console.log(data)
				$(".city option:selected").text(data)
			}
		});
	}

})

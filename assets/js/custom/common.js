$("document").ready(function () {
	
$('.admission-form').hide();
$("body").on("click", ".apply_now", function (e) {
	e.preventDefault();
	$('#notes_bored').hide();
	$('.admission-form').show();
})




})


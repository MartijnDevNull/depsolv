$(document).ready(function() {

	// this is the id of the form
	var activeSystemClass = $('.list-group-item.active');
	$("#formSub").submit(function() {
		var tableBody = $('.table-list-search tbody');
		var tableRowsClass = $('.table-list-search tbody tr');
		var url = "backend/api.php"; // the script where you handle
		// the form input.
		$.ajax({
			type : "POST",
			url : url,
			data : $("#formSub").serialize(), // serializes the form's
			// elements.
			success : function(data) {
				tableBody.empty();
				tableBody.prepend(data);
				$(".empty").hide();
			}
		});

		return false; // avoid to execute the actual submit of the form.
	});
});
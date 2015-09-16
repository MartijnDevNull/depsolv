$(document)
	.ready(
		function() {
			$('.loading').hide();
			// this is the id of the form
			var activeSystemClass = $('.list-group-item.active');

			$("#formSub")
				.submit(
					function() {
						var tableBody = $('.table-list-search tbody');
						var tableRowsClass = $('.table-list-search tbody tr');
						var url = "backend/api.php";
						$
							.ajax({
								type : "POST",
								url : url,
								data : $("#formSub").serialize(),

								beforeSend : function() {
									tableBody.empty();
									$('.loading').show();
								},
								complete : function() {
									$('.loading').hide();
								},
								success : function(data) {
									obj = JSON.parse(data);
									$.each(obj, function(index, value) {
										tableBody
										.prepend("<tr class=\"search-query-sf\">" 
											+ "<td>" + value.NAME + "</td>"
											+ "<td>" + value.DESC + "</td>"
											+ "<td>" + value.PATH + "</td>"
											+ "<td><a id=\"copy\" onClick=\"setClipboard('" + value.NAME +"')\" class=\"btn btn-primary transparant\">"
											+ "<span class=\"glyphicon glyphicon-copy\"></span></a></td></tr>");
									});
								}
							});
						$(".empty").hide();

						return false;
					});
		});

function setClipboard($naam) {
	alert($naam);
	return false;
};
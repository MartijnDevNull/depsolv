$(document)
	.ready(
		function() {
			// this is the id of the form
			var activeSystemClass = $('.list-group-item.active');

			$("#formSub")
				.submit(
					function() {
						var tableBody = $('.table-list-search tbody');
						var tableRowsClass = $('.table-list-search tbody tr');
						var url = "https://api.plebian/backend/api.php";
						$
							.ajax({
								type : "POST",
								url : url,
								data : $("#formSub").serialize(),

								beforeSend : function() {
									tableBody.empty();
									$(".empty").hide();
									$(".loading").html("<br> <img src=\"img/loading.gif\" alt=\"Loading please wait\" style=\"width: 60px; length: 60px;\">")
									$('.loading').show();
								},
								complete : function() {
									$('.loading').hide();
								},
								success : function(data) {
									obj = JSON.parse(data);
									if (obj.ERROR != "TOOSMALL"){
										if (obj.ERROR != "EMPTY"){
											$.each(obj, function(index, value) {
												tableBody
												.prepend("<tr class=\"search-query-sf\">" 
													+ "<td><a href=\"https://packages.debian.org/search?keywords=" + value.NAME + "\" target=\"_blank\" >" + value.NAME + "</td>"
													+ "<td>" + value.DESC + "</td>"
													+ "<td>" + value.PATH + "</td>"
													+ "<td><a id=\"copy\" onClick=\"setClipboard('" + value.NAME +"')\" class=\"btn btn-primary transparant\">"
													+ "<span class=\"glyphicon glyphicon-copy\"></span></a></td></tr>");
											});
										} else if (obj.ERROR == "EMPTY") {
											$(".empty").show();
											$(".empty").text("Search resulted in 0 results, please check your search query");
										}
									} else if (obj.ERROR == "TOOSMALL") {
										$(".empty").show();
										$(".empty").text("Search query is 2 characters or less, please use a more specific search");
									} 
								}
							});
						return false;
					});
		});

function setClipboard(naam) {
	prompt("Press CTRL + C top copy", "sudo apt-get install " + naam);
	return false;
};
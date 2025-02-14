/** @format */

$(document).ready(function () {
	// When 'Load Page 1' button is clicked
	$(".loadPage").click(function () {
		loadContent("home");
	});
});

// Function to load content dynamically using AJAX
function loadContent(page) {
	$.ajax({
		url: "js/common/loadContent.php", // This is the PHP file where you handle the dynamic content
		type: "GET",
		data: { page: page },
		success: function (response) {
			// Insert the returned content into the content div
			initHome();
			$("#contentArea").html(response);
		},
		error: function () {
			$("#contentArea").html("Error loading content.");
		},
	});
}

function initHome() {
	pages = [
		"#contentHome",
		"#contentProfil",
		"#reseverAppointment",
		"#medecin",
		"#myAppointments",
	];

	pages.forEach((element) => {
		console.log(element);
		$(element).hide();
	});
	$;
}

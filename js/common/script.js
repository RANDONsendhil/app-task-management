/** @format */
var login = false;
$(document).ready(function () {
	loadContent("home");
});

// Function to load content dynamically using AJAX
function loadContent(page) {
	return;
	$.ajax({
		url: "loadContent_77.php", // This is the PHP file where you handle the dynamic content
		type: "GET",
		data: { page: page },
		success: function (response) {
			// Insert the returned content into the content div
			// hideDisplay();
			console.log(page);

			$("#contentArea").html(response);
		},
		error: function () {
			$("#contentArea").html("Error loading content.");
		},
	});
}

function init() {
	//displayHome on init
	if (login === true) {
		loadContent("home");
		return "logged in";
	}
}

function hideDisplay() {
	pages = [
		"#contentHome",
		"#contentProfil",
		"#reseverAppointment",
		"#medecin",
		"#myAppointments",
	];

	pages.forEach((element) => {
		$(element).hide();
	});
	$;
}

function redirectPage(page) {
	console.log("Called redirect ");

	window.location.href = page;
}

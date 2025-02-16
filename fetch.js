/** @format */

function fetchData(path) {
	$.ajax({
		url: path, // PHP file that fetches data from the database
		method: "GET", // HTTP method (GET or POST)
		success: function (response) {
			console.log(response);

			// Append the response (user data) to the div with id 'user-data'
			$("#user-data").html(response);
		},
		error: function () {
			console.log("An error occurred while fetching data.");
		},
	});
}

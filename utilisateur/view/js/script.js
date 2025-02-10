/** @format */

const inputId = document.getElementById("userId");
const modal = document.getElementById("form_user");
const divId = document.getElementById("divId");

window.onclick = function (event) {
	const modal = document.getElementById("form_user");
	const span = document.getElementsByClassName("close")[0];
	if (event.target == modal || event.target == span) {
		modal.style.display = "none";
	}
};

function display_userCreation_form() {
	console.log("here");
	inputId.value = null;
	inputId.style.display = "none";
	modal.style.display = "block";
	divId.style.display = "none";
}

function updateUser(idUser) {
	inputId.readOnly = true;
	inputId.value = parseInt(idUser);
	modal.style.display = "block";
	divId.style.display = "block";
	inputId.style.display = "block";
}

function validateFormUserCreation() {
	var username = document.getElementById("username").value;
	var userAddress = document.getElementById("userAddress").value;

	if (username === "" || userAddress === "") {
		return false;
	}
	return true;
}

/** @format */
console.log(window.location.pathname);

if (
	window.location.pathname === "/" ||
	window.location.pathname === "/login" ||
	window.location.pathname === "/userCreation"
) {
	document.querySelector(".navbar").style.display = "block";
} else {
	document.querySelector(".navbar").style.display = "none";
}

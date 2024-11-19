window.onclick = function(event) {
  const modal = document.getElementById("form_user");
  const span = document.getElementsByClassName("close")[0];
  if ((event.target == modal) || (event.target == span )){
    modal.style.display = "none";
    console.log("CLICK WIND");
    
  }
}

function display_userCreation_form(){
  const modal = document.getElementById("form_user");
  modal.style.display = "block";
   
}
 
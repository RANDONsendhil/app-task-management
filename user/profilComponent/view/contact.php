<?php
include(BASE_PATH . '/user/homeComponent/view/home.php');
?>
<style>
input[type=text],
textarea,
input[type=email] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  margin-right: 0px;
  margin-left: 0px;
  resize: vertical;
}

label {
  margin-right: 0px;
  margin-left: 0px;
  width: 100%;
}

input[type=submit] {
  background-color: #1255a2;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #1872D9;
}

#containerContant {
  max-width: 950px;
  margin: auto;

}


h1 {
  color: #1255a2;
  ;
  width: 100%;
}
</style>
<div class="content">

  <div class="">
    <fieldset>
      <legend>
        <h4>Contact Assistant</h4>
      </legend>

      <div class="container shadow-lg p-3  bg-body-tertiary rounded">
        <div id="containerContant">

          <h5>Formulaire de contact</h5>
          <form action="/action_page.php">
            <label for="fname">Nom & prénom</label>
            <input type="text" id="fname" name="firstname" placeholder="Votre nom et prénom">

            <label for="sujet">Sujet</label>
            <input type="text" id="sujet" name="sujet" placeholder="L'objet de votre message">

            <label for="emailAddress">Email</label>
            <input id="emailAddress" type="email" name="email" placeholder="Votre email">


            <label for="subject">Message</label>
            <textarea id="subject" name="subject" placeholder="Votre message" style="height:200px"></textarea>

            <input type="submit" value="Envoyer">
          </form>
        </div>


      </div>
  </div>
</div>
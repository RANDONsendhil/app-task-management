<style>
.containerlog {
  display: flex;
  padding: 9px;
  color: rgb(230 252 255);
  align-items: center;
  justify-content: flex-end;
  flex-direction: column;
  font-size: 14px;
  font-weight: 500;
}

#logo {
  height: 25px;
  width: 25px;
  background: #0a485a;
}

hr {
  border: none;
  height: 2px;
  /* background-color: #ccc; */
  background-color: white;
}

#for_logout {
  cursor: pointer;
  font-size: 11px;
}

#profil_name {
  color: #15caff;
  font-size: large;
}
</style>

<?php session_start()
?>

<div class="sidebar">
  <ul class="nav flex-column">
    <li class="nav-item">
      <div id="username-sidebar" class="nav-link" href="#submenu1" aria-expanded="false" aria-controls="submenu1">

      <hr>
        <div class="containerlog">
          <div class="containerlog" id="profil_name">
            <div><?php echo strtoupper($_SESSION["lname"]) ?></div>
            <div><?php echo ucfirst($_SESSION["fname"]);
                  ?>
            </div>
          </div>
        </div>
        <hr>
        
   
        <div class="containerlog" id="for_logout" onclick="logout()">
          <div>
            <img style="border-radius: 50%;" id="logo" src="/images/se_deconnecter.png" alt="" srcset="">
          </div>
          <div style="color:#2f87e1">
            Se déconnecter
          </div>
        </div>
        <hr>
        <!-- Menu 1 -->
    <li class="nav-item">
      <div href="#submenu1" aria-expanded="false" aria-controls="submenu1">
        Activité
      </div>
      <div class="nav-custom-sidebar">
        <ul class="nav flex-column submenu">
          <li><a class="nav-link" href="/home" id="home"><span> <img style="height: 39px;" src="/images/graph.png"
                  alt="" srcset=""></span>
              <span>Tableau de bord</span></a></li>
        </ul>
      </div>
    </li>

    <!-- Menu 2 -->
    <li class="nav-item">
      <div href="#submenu2" aria-expanded="false" aria-controls="submenu2">
        Paramètres
      </div>
      <!-- <div class="nav-custom-sidebar" onclick="loadContent('profil')"> -->
      <div class="nav-custom-sidebar">
        <ul class="nav flex-column submenu">
          <li><a class="nav-link" href="/profil"><span> <img style="height: 39px;" src="/images/person_1.svg" alt=""
                  srcset=""></span><span>Profil</span></a>
          </li>
        </ul>
      </div>
    </li>

    <!-- Menu 3 -->
    <li class=" nav-item">
      <div href="#submenu3" aria-expanded="false" aria-controls="submenu3">
        Information
      </div>
      <div class="nav-custom-sidebar">
        <ul class="nav flex-column submenu">

          <li><a class="nav-link" href="find-doctors"><span> <img style="height: 30px;" src="/images/location.png"
                  alt="" srcset=""></span><span>Trouver un medecin</span></a></li>
        </ul>
      </div>
    </li>

    <!-- Menu 4 -->
    <li class="nav-item">
      <div href="#submenu3" aria-expanded="false" aria-controls="submenu4">

        Contact
      </div>
      <div class="nav-custom-sidebar" id="nav-contact">
        <ul class="nav flex-column submenu">
          <li><a class="nav-link" href="/contact-assistant"><span> <img style="height: 30px;" src="/images/mail.png"
                  alt="" srcset=""></span><span>Contact Assistant</span></a></li>
        </ul>
      </div>
    </li>
  </ul>
  <hr>
</div>

<div class="main-container">
  <div class="container-fluid" id="navbarHome">
    <div class="d-flex justify-content-center align-items-center navbar-container">
     <h3>GESTION DE PROJECT V1</h3>
    </div>
  </div>

  <script>
  function logout() {
    window.location.href = "/login"; // Redirects to "/profil"
  }
  </script>
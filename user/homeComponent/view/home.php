<div class="sidebar">
  <ul class="nav flex-column">
    <li class="nav-item">
      <div id="username-sidebar" class="nav-link" href="#submenu1" aria-expanded="false" aria-controls="submenu1">
        <a class="nav-link" href="#"> User name</a>
      </div>
      <!-- Menu 1 -->
    <li class="nav-item">
      <div class="nav-link" href="#submenu1" aria-expanded="false" aria-controls="submenu1">
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
      <div class="nav-link" href="#submenu2" aria-expanded="false" aria-controls="submenu2">
        Paramètres
      </div>
      <!-- <div class="nav-custom-sidebar" onclick="loadContent('profil')"> -->
      <div class="nav-custom-sidebar">
        <ul class="nav flex-column submenu">
          <li><a class=" nav-link" href="/profil"><span> <img style="height: 39px;" src="/images/person_1.svg" alt=""
                  srcset=""></span><span>Profil</span></a>
          </li>
        </ul>
      </div>
    </li>

    <!-- Menu 3 -->
    <li class=" nav-item">
      <div class="nav-link" href="#submenu3" aria-expanded="false" aria-controls="submenu3">
        Information
      </div>
      <div class="nav-custom-sidebar">
        <ul class="nav flex-column submenu" onclick="loadContent('findSpecialist')">

          <li><a class="nav-link" href="#"><span> <img style="height: 30px;" src="/images/location.png" alt=""
                  srcset=""></span><span>Trouver un medecin</span></a></li>
        </ul>
      </div>
    </li>
    <!-- Menu 4 -->
    <li class="nav-item">
      <div class="nav-link" href="#submenu3" aria-expanded="false" aria-controls="submenu4">

        Contact
      </div>
      <div class="nav-custom-sidebar" id="nav-contact">
        <ul class="nav flex-column submenu">
          <li><a class="nav-link" href="#"><span> <img style="height: 30px;" src="/images/mail.png" alt=""
                  srcset=""></span><span>Contact Assistant</span></a></li>
        </ul>
      </div>
    </li>
  </ul>
</div>
<div class="main-container">
  <div class="container-fluid" id="navbarHome">
    <div class="d-flex justify-content-center align-items-center navbar-container">
      <ul class="contianer-nav-bar navbar-nav mx-auto ">
        <li class=" nav-item mx-2">
          <a id="numeroUrgence" class="nav-link" href="/contactNumUrg" style="color: white;">Numeréo urgences</a>
        </li>
        <li class="nav-item nav-item mx-2 ">
          <a class=" nav-link" href="#" style="color: white;">Questions fréquentes</a>
        </li>
        <li class="nav-item nav-item mx-2">
          <a class=" nav-link" href="#" style="color: white;">Professionnels de santé</a>
        </li>
      </ul>
    </div>
  </div>
<style>
#navbar-home {
  background-color: #0a485a !important;
  border-radius: 0px !important;
}

.navbar-light .navbar-nav .nav-link {
  font-size: large;
  color: white !important;
}

legend {
  text-align: center !important;
}

.card-title {
  color: #063846;
  font-size: 20px !important;
}

.btn {
  font-weight: 150;
  font-size: 15px;
}

.container-card {
  margin: auto;

  height: 800px;
  padding: 45px;
}

.card-text {
  font-size: 14px;
}

.card {
  display: flex;
  flex-direction: row;
  gap: 23px;
  top: 16px;
  max-width: 938px;
  margin: auto;
  padding: 22px 14px 19px 19px;
  background-color: #dddddd;
  justify-content: space-between;
}

.sidebar {
  height: 100vh;
  width: 250px;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #000000;
  padding-top: 10px;
  text-overflow: ellipsis;
  white-space: nowrap;
  font-size: 12px;
}


.sidebar a {
  color: white !important;
  display: block;
  text-decoration: none;
  color: #333;
}

.submenu {
  padding-left: 7px;
}

.nav-link {
  color: rgb(172, 169, 169) !important;
}
</style>
<div id="contentSidebar">
  <div class="sidebar">
    <ul class="nav flex-column">
      <li class="nav-item">
        <div id="username-sidebar" class="nav-link" href="#submenu1" aria-expanded="false" aria-controls="submenu1">
          <a class="nav-link" href="#"> User name</a>
        </div>

      </li>
      <br></br>


      <!-- Menu 1 -->
      <li class="nav-item">
        <div class="nav-link" href="#submenu1" aria-expanded="false" aria-controls="submenu1">
          Activité
        </div>
        <div class="nav-custom-sidebar" id="nav-tableau">
          <ul class="nav flex-column submenu">
            <li><a class="nav-link" href="#" class="loadPage" data-page="home"><span> <img style="height: 39px;"
                    src="/images/graph.png" alt="" srcset=""></span>
                <span>Tableau
                  de bord</span></a></li>

          </ul>
        </div>
      </li>

      <!-- Menu 2 -->
      <li class="nav-item">
        <div class="nav-link" href="#submenu2" aria-expanded="false" aria-controls="submenu2">
          Paramètres
        </div>
        <div class="nav-custom-sidebar" id="nav-profil">
          <ul class="nav flex-column submenu">
            <li><a class="nav-link" href="#" class="loadPage" data-page="profil"><span> <img style="height: 39px;"
                    src="/images/person_1.svg" alt="" srcset=""></span><span>Profil</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Menu 3 -->
      <li class="nav-item">
        <div class="nav-link" href="#submenu3" aria-expanded="false" aria-controls="submenu3">
          Information
        </div>
        <div class="nav-custom-sidebar" id="nav-find">
          <ul class="nav flex-column submenu">

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
</div>

<!-- <div class="content-home" id="home" style="margin-left: 250px;"> -->
<div id="contentNav">
  <div class="container-nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar-home">
      <div class="container-fluid" id="container-nav-bar">
        <div class="d-flex justify-content-center align-items-center navbar-container">
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto ">
              <li class="nav-item mx-2">
                <a id="creation_compte_link" class="nav-link" href="/contactNumUrg">Numeréo urgences</a>
              </li>
              <li class="nav-item nav-item mx-2">
                <a class="nav-link" href="#">Questions fréquentes</a>
              </li>
              <li class="nav-item nav-item mx-2">
                <a class="nav-link" href="#">Professionnels de santé</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
</div>

<div id="contentHome">
  <fieldset>
    <div class="container-card">
      <legend>
        <h5>TABLEAU DE BORD</h5>
      </legend>

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Prendre un rendez vous</h4>
          <p class="card-text">Prenez votre rendez vous en ligne</p>
          <a href="#" class="btn btn-dark btn-lg">Rendez-vous</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Mes Rendez-vous</h4>
          <p class="card-text">Afficher les rendez-vous en cours, les rendez-vous passés.</p>
          <a href="#" class="btn btn-dark btn-lg">Afficher mes rendez-vous</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Les Medecins</h4>
          <p class="card-text">Afficher la liste des médecin du cabinet</p>
          <a href="#" class="btn btn-dark btn-lg">Afficher les medecins</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-dark btn-lg">Go somewhere</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-dark btn-lg">Go somewhere</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-dark btn-lg">Go somewhere</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary btn-lg">Go somewhere</a>
        </div>
      </div>
    </div>

  </fieldset>
</div>
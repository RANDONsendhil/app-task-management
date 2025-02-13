<style>
  /* Custom styles for sidebar */
  .sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #000000;
    padding-top: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }


  .sidebar a {
    color: white !important;
    padding: 10px 0px;
    display: block;
    text-decoration: none;
    color: #333;
  }


  .submenu {
    padding-left: 30px;
  }

  .nav-link {
    color: rgb(172, 169, 169) !important;
  }

  .nav-item a span {
    margin: 0px 5px;

  }
</style>
<fieldset>
  <!-- Sidebar -->
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
        <div class="nav-custom-sidebar" id="navTableaubord">
          <ul class="nav flex-column submenu">
            <li><a class="nav-link" href="#"><span> <img style="height: 39px;" src="/images/graph.png" alt=""
                    srcset=""></span>
                <span>Tableau de bord</span></a></li>

          </ul>
        </div>
      </li>

      <!-- Menu 2 -->
      <li class="nav-item">
        <div class="nav-link" href="#" aria-expanded="false">
          Paramètres
        </div>
        <div class="nav-custom-sidebar" id="nav-profil">
          <ul class="nav flex-column submenu">
            <li><a class="nav-link" href="#"><span> <img style="height: 39px;" src="/images/person_1.svg" alt=""
                    srcset=""></span><span>Profil</span></a></li>
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
</fieldset>
<style>
  /* Modern Navigation Styling */
  .navbar {
    background: linear-gradient(135deg, #2a7a8a 0%, #3d8a9b 50%, #2a7a8a 100%) !important;
    box-shadow: 0 4px 20px rgba(42, 122, 138, 0.3);
    border: none;
    padding: 15px 0;
    position: relative;
    overflow: hidden;
  }

  .navbar::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer-nav 3s infinite;
  }

  @keyframes shimmer-nav {
    0% { left: -100%; }
    100% { left: 100%; }
  }

  #container-nav-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 2;
  }

  /* Main Title Styling */
  .navbar h3 {
    color: #ffffff;
    font-size: 1.75rem;
    font-weight: 600;
    margin: 0;
    text-align: center;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    letter-spacing: 1.5px;
    position: relative;
    animation: glow 2s ease-in-out infinite alternate;
  }

  @keyframes glow {
    from {
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3),
                   0 0 20px rgba(255, 255, 255, 0.2);
    }
    to {
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3),
                   0 0 30px rgba(255, 255, 255, 0.4),
                   0 0 40px rgba(255, 255, 255, 0.2);
    }
  }

  /* Project Icon Styling */
  .project-icon {
    display: inline-block;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #2a7a8a, #469aaa);
    border-radius: 12px;
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(42, 122, 138, 0.4);
    animation: pulse-icon 2s infinite;
    border: 2px solid rgba(255, 255, 255, 0.2);
  }

  @keyframes pulse-icon {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }

  /* Version Badge */
  .version-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-left: 15px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .navbar h3 {
      font-size: 1.4rem;
      letter-spacing: 1px;
    }
    
    .project-icon {
      width: 40px;
      height: 40px;
      font-size: 20px;
      margin-right: 15px;
    }
    
    .version-badge {
      display: block;
      margin: 10px auto 0;
      text-align: center;
      width: fit-content;
    }
  }

  @media (max-width: 480px) {
    .navbar h3 {
      font-size: 1.2rem;
    }
    
    .navbar {
      padding: 10px 0;
    }
  }

  /* Additional Container Styling */
  .nav-title-container {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
  }

  /* Hover Effects */
  .navbar:hover::before {
    animation-duration: 1.5s;
  }

  .navbar h3:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbarLogin" style="color: #000 !important;">
  <div class="container-fluid" id="container-nav-bar">
    <!-- <a id="logoPng" class="nav-item" href="/">
      <img style="height: 100px;" src="/images/logo.png" alt="" srcset="">
    </a> -->
    <!------ NAV BAR ITEM ------>
    <div class="nav-title-container">
      <div class="project-icon">📋</div>
      <h3>GESTION DE PROJECT
        <span class="version-badge">V1.0</span>
      </h3>
    </div>
    <!------ NAV BAR ITEM ------>
    <!-- <div class="container-login">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <div id="anim-login">
            <a id="nav-login" class="nav-link" href="/login">
              Mon Compte
              <img src="images/person_1.svg" alt="Mon Compte">
            </a>
          </div>
        </li>
      </ul>
    </div> -->
  </div>
</nav>
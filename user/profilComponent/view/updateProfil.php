<?php

define('BASE_PATH', __DIR__);

include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();

$status = isset($_SESSION['retStatus']) ? $_SESSION['retStatus'] : null;
$message = isset($_SESSION['retMessage']) ? $_SESSION['retMessage'] : "";
unset($_SESSION['statusDelete']);
unset($_SESSION['message']);
?>

<style>
  .user-board {
    background: #f6f7fb;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin: 20px 0;
    overflow: hidden;
  }

  .board-header {
    background: #ffffff;
    padding: 20px 24px;
    border-bottom: 1px solid #e6e9ef;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .board-title {
    font-size: 24px;
    font-weight: 600;
    color: #323338;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .board-icon {
    width: 24px;
    height: 24px;
    background: #6161ff;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 14px;
  }

  .board-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
  }

  .board-table thead {
    background: #f8f9fd;
    position: relative;
  }

  .board-table thead::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #0085ff, #6161ff, #0085ff);
    background-size: 200% 100%;
    animation: shimmer 3s ease-in-out infinite;
  }

  @keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
  }

  .board-table th {
    padding: 12px 16px;
    text-align: left;
    font-weight: 500;
    font-size: 14px;
    color: #676879;
    border-bottom: 1px solid #e6e9ef;
    border-right: 1px solid #e6e9ef;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
    user-select: none;
    background: linear-gradient(135deg, #f8f9fd, #e6e9ef);
  }

  .board-table th:hover {
    background: linear-gradient(135deg, #e6e9ef, #d0d4da);
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .board-table th:last-child {
    border-right: none;
  }

  .board-table td {
    padding: 12px 16px;
    border-bottom: 1px solid #e6e9ef;
    border-right: 1px solid #e6e9ef;
    vertical-align: middle;
  }

  .board-table td:last-child {
    border-right: none;
  }

  .board-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fd, #ffffff);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }

  .user-name-cell {
    font-weight: 500;
    color: #323338;
    font-size: 14px;
  }

  .user-id-cell {
    font-weight: 600;
    color: #0085ff;
    font-size: 14px;
  }

  .user-email-cell {
    color: #676879;
    font-size: 14px;
  }

  .user-phone-cell {
    color: #323338;
    font-size: 14px;
  }

  .user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #6161ff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 500;
    margin-right: 10px;
  }

  .user-info-cell {
    display: flex;
    align-items: center;
  }

  .profile-section {
    margin-bottom: 30px;
  }
</style>


<div class="container-card">

  <fieldset>
    <legend>
      <h5>MODFIFICATION DU PROFIL</h5>
    </legend>

    <div class="content-container">
      <div class="container shadow-lg p-3  bg-body-tertiary rounded" id="containerCreationCompte">
        <form class="row g-2" method="POST" action="/profil">

          <div class="form-group">
            <?php htmlspecialchars($_SESSION['genre']) ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="madame" name="genre" value="madame"
                <?php if (htmlspecialchars($_SESSION['genre']) == "madame") echo "checked"; ?>>
              <label class="form-check-label" for="madame" value=checked> Madame</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="monsieur" name="genre" value="monsieur"
                <?php if (htmlspecialchars($_SESSION['genre']) == "monsieur") echo "checked"; ?>>
              <label class="form-check-label g-col-md-" for=" monsieur"> Monsieur
            </div>
          </div>
          <div class="col-12">
            <label for="inputAddress">Numéro de Sécurité Sociale</label>
            <input type="text" class="form-control" id="numSS" name="numSS"
              value="<?php echo htmlspecialchars($_SESSION['numSS']) ?>" required>
          </div>
          <div class="col-md-6">
            <label for="lname">Nom*</label>
            <input type="text" class="form-control" id="lname" name="lname"
              value="<?php echo htmlspecialchars($_SESSION['lname']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="sname">Prénom*</label>
            <input type="text" class="form-control" id="fname" name="fname"
              value="<?php echo htmlspecialchars($_SESSION['fname']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="inputEmail">Email*</label>
            <input type="text" class="form-control" id="inputEmail" , name="inputEmail"
              value="<?php echo htmlspecialchars($_SESSION['inputEmail']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="inputPassword">Mot de Passe*</label>
            <input type="text" class="form-control" id="inputPassword" name="inputPassword"
              value="<?php echo htmlspecialchars($_SESSION['inputPassword']) ?>" required>
          </div>

          <div class=" col-md-6">
            <label for="mobileNum">Téléphone Portable*</label>
            <input type="text" class="form-control" id="mobileNum" name="mobileNum"
              value="<?php echo htmlspecialchars($_SESSION['mobileNum']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="phoneNum">Téléphone Fixe</label>
            <input type="text" class="form-control" id="phoneNum" name="phoneNum"
              value="<?php echo htmlspecialchars($_SESSION['phoneNum']) ?>" required>
          </div>

          <div class=" col-12">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress"
              value="<?php echo htmlspecialchars($_SESSION['inputAddress']) ?>">
          </div>
          <div class=" col-md-6">
            <label for="inputCity">Commune</label>
            <input type="text" class="form-control" id="inputCity" name="inputCity"
              value="<?php echo htmlspecialchars($_SESSION['inputCity']) ?>">
          </div>

          <div class=" col-md-6">
            <label for="inputZip">Code Postal</label>
            <input type="text" class="form-control" id="inputZip" name="inputZip"
              value="<?php echo htmlspecialchars($_SESSION['inputZip']) ?>">
          </div>

          <div class="d-grid gap-2 mt-4 d-flex justify-content-end">
            <div class="grid text-center d-inline-flex gap-1">
              <div class="fg-col-4">
                <input class="btn btn-secondary btn-sm" value=" Abandonner" onclick="redirectPage('/profil')">
              </div>
              <div class="g-col-4">
                <input class="btn btn-primary btn-sm" type="submit" name="save-update-profil"
                  value="Mettre à jour mon Profil">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </fieldset>
</div>
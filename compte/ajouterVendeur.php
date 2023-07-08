<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Inscription - Agora Francia</title>
  <link rel="stylesheet" href="../compte/form.css">
</head>
<body>
  <?php
    session_start();
    $database = "piscine";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    if($db_found) {
    if (isset($_POST['Inscription'])) {
      $pseudo = isset($_POST["Pseudo"]) ? $_POST["Pseudo"] : "";
      $nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
      $prenom = isset($_POST["Prenom"]) ? $_POST["Prenom"] : "";
      $mail = isset($_POST["Mail"]) ? $_POST["Mail"] : "";
      $mdp = isset($_POST["Mdp"]) ? $_POST["Mdp"] : "";
      $sql = "SELECT * FROM vendeur WHERE Mail = '$mail'";
      $result = mysqli_query($db_handle, $sql);
      if (mysqli_num_rows($result) > 0) {
  ?>
  <script type='text/javascript'>
      alert('Cet email est déjà utilisé. Veuillez en choisir un autre.');
      window.location.href = '../compte/ajouterVendeur.php';
  </script>
  <?php
      } else {
        // Vérifier si le nom d'utilisateur est déjà utilisé
          $sql = "SELECT * FROM vendeur WHERE Pseudo = '$pseudo'";
          $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) > 0) {
  ?>
  <script type='text/javascript'>
      alert('Ce nom d\'utilisateur est déjà utilisé. Veuillez en choisir un autre.');
      window.location.href = '../compte/ajouterVendeur.php';
  </script>
  <?php
        } else {
          $sql = "INSERT INTO vendeur (`ID`, `Nom`, `Prenom`, `Pseudo`, `Mail`, `Mdp`, `Photo`, `Fond`, `Solde`) VALUES (NULL, '$nom', '$prenom', '$pseudo', '$mail', '$mdp', '', '', '');";
          $result = mysqli_query($db_handle, $sql);
          header('Location: ../compte/ajouterRetirerVendeur.php');
          exit();
        }
      }
    }
  }
  ?>
  <div class="center">
    <h1>Inscription Vendeur</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="txt_field">
        <input type="text" required name="Prenom">
        <span></span>
        <label>Prénom *</label>
      </div>
      <div class="txt_field">
        <input type="text" required name="Nom">
        <span></span>
        <label>Nom *</label>
      </div>
      <div class="txt_field">
        <input type="text" required name="Pseudo">
        <span></span>
        <label>Pseudonyme *</label>
      </div>
      <div class="txt_field">
        <input type="mail" required name="Mail">
        <span></span>
        <label>Adresse email *</label>
      </div>
      <div class="txt_field">
        <input type="password" required name="Mdp">
        <span></span>
        <label>Mot de passe *</label>
      </div>
      <input type="submit" name="Inscription" value="Ajouter">
    </form>
  </div>
</body>
</html>
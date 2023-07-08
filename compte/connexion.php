<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <style>
    .texte {
      opacity: 0;
    }
  </style>
  <meta charset="utf-8">
  <title>Connexion à votre compte - Agora Francia</title>
  <link rel="stylesheet" href="../compte/form.css">
</head>
<body>
  <?php
    session_start();
    $statut = $_SESSION['Statut'];
    switch($statut) {
      case 'Admin':
  ?>
  <div class="center">
    <h1>Connexion Administrateur</h1>
    <form method="post" action="../compte/connexionInscription.php">
      <div class="txt_field">
        <input type="text" required name="Pseudo">
        <span></span>
        <label>Pseudonyme</label>
      </div>
      <div class="txt_field">
        <input type="password" required name="Mdp">
        <span></span>
        <label>Mot de passe</label>
      </div>
      <input type="hidden" name="Statut2" value="Admin">
      <input type="submit" name="Connexion" value="Se connecter">
      <div class="texte">Agora Francia</a></div>
    </form>
  </div>
  <?php
      break;
  ?>
  <?php
      case 'Acheteur':
  ?>
  <div class="center">
    <h1>Connexion Acheteur</h1>
    <form method="post" action="../compte/connexionInscription.php">
      <div class="txt_field">
        <input type="text" required name="Mail">
        <span></span>
        <label>Adresse email</label>
      </div>
      <div class="txt_field">
        <input type="password" required name="Mdp">
        <span></span>
        <label>Mot de passe</label>
      </div>
      <input type="hidden" name="Statut2" value="Acheteur">
      <input type="submit" name="Connexion" value="Se connecter"><br>
      <div class="signup_link">Vous n'avez pas de compte ? <a href="../compte/inscription.php">S'inscrire</a></div>
      <div class="white"></a></div>
    </form>
    <form class="" action="../emails/send.php" method="post">
  </form>
  </div>
  <?php
      break;
  ?>
  <?php
      case 'Vendeur':
  ?>
  <div class="center">
    <h1>Connexion Vendeur</h1>
      <form method="post" action="../compte/connexionInscription.php">
        <div class="txt_field">
          <input type="text" required name="Pseudo">
          <span></span>
          <label>Pseudonyme</label>
        </div>
        <div class="txt_field">
          <input type="text" required name="Mail">
          <span></span>
          <label>Adresse email</label>
        </div>
        <input type="hidden" name="Statut2" value="Vendeur">
        <input type="submit" name="Connexion" value="Se connecter">
        <div class="signup_link">Vous n'avez pas de compte ? <a href="../compte/inscription.php">S'inscrire</a></div>
    </form>
  </div>
  <?php
      break;
  ?>
  <?php
    }
  ?>
</body>
</html>
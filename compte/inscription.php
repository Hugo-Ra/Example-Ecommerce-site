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
    $statut = $_SESSION['Statut'];
    switch($statut) {
      case 'Acheteur':
  ?>
  <div class="center">
    <h1>Inscription Acheteur</h1>
    <form method="post" action="../compte/connexionInscription.php">
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
        <input type="mail" required name="Mail">
        <span></span>
        <label>Adresse email *</label>
      </div>
      <div class="txt_field">
        <input type="password" required name="Mdp">
        <span></span>
        <label>Mot de passe *</label>
      </div>
      <input type="submit" name="Inscription" value="S'inscrire">
      <div class="signup_link">Êtes-vous déjà inscrit ? <a href="../compte/connexion.php">Se connecter</a></div>
    </form>
  </div>
  <?php
      break;
  ?>
  <?php
      case 'Vendeur':
  ?>
  <div class="center">
    <h1>Inscription Vendeur</h1>
    <form method="post" action="../compte/connexionInscription.php">
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
      <input type="submit" name="Inscription" value="S'inscrire">
      <div class="signup_link">Êtes-vous déjà inscrit ? <a href="../compte/connexion.php">Se connecter</a></div>
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
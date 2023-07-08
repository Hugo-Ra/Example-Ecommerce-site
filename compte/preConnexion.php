<?php
  session_start(); // Démarrer la session
  $database = "piscine";
  $db_handle = mysqli_connect('localhost', 'root', '');
  $db_found = mysqli_select_db($db_handle, $database);
  $admin = isset($_POST["Admin"]) ? $_POST["Admin"] : "";
  $acheteur = isset($_POST["Acheteur"]) ? $_POST["Acheteur"] : "";
  $vendeur = isset($_POST["Vendeur"]) ? $_POST["Vendeur"] : "";
  $statut = isset($_POST["Statut"]) ? $_POST["Statut"] : "";
  $statut2 = isset($_POST["Statut2"]) ? $_POST["Statut2"] : "";
  if(isset($_POST["Admin"]))
  {
    $_SESSION['Statut'] = "Admin";
  }
  else if(isset($_POST["Acheteur"]))
  {
    $_SESSION['Statut'] = "Acheteur";
  }
  else if(isset($_POST["Vendeur"]))
  {
    $_SESSION['Statut'] = "Vendeur";
  }
  header("Location: ../compte/connexion.php");
  mysqli_close($db_handle);
?>
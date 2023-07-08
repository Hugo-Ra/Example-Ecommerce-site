<?php
	session_start();
	$database = "piscine";
	$db_handle = mysqli_connect('localhost', 'root', '');
	$db_found = mysqli_select_db($db_handle, $database);
	$statut = $_SESSION['Statut'];
	switch($statut) {
		case 'Admin':
			$pseudo = $_SESSION['Pseudo'];
			$mdp = $_SESSION['Mdp'];
			$solde = $_SESSION['Solde'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../img-images/favicon.ico"/>
	<title>Votre Compte : Administrateur - Agora Francia</title>
	<link href="../styles.css" rel="stylesheet" type="text/css"/>
	<link href="../compte/compte.css" rel="stylesheet" type="text/css"/>
	<!-- Importation de Font Awesome via un lien CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.header').height($(window).height());
		});
	</script>
</head>
<body>
	<?php
	if (isset($_GET['logout'])) {
		session_destroy();
		sleep(1);
		header("Location: ../accueil/accueil.php");
		exit();
	}
	if (isset($_POST['SupprimerArticle'])) {
		$ID_itemSuppr = $_POST['ID_itemSuppr'];
		$sql = "DELETE FROM item WHERE ID = '$ID_itemSuppr';";
		$result = mysqli_query($db_handle, $sql);
	}
	?>
	<div id="wrapper">
        <div id="header">
            <h1>Agora</h1>
            <img class="rotation-horizontale" src="../img-images/logo.png" alt="Logo Agora Francia" height="100" width="100">
            <h1>Francia</h1>
        </div>
        <div id="nav">
            <div class="boutons-1-2">
                <a class="bouton" href="../accueil/accueil.php">Accueil</a>
                <a class="bouton" href="../parcourir/parcourir.php">Tout Parcourir</a>
            </div>
            <div class="boutons-3-4-5">
                <div class="element">
                    <a class="bouton" href="../notifications/notifications.php">Notifications</a>
                    <a class="wobble-hor-top" href="../notifications/notifications.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/>
                        </svg>
                    </a>
                </div>
                <div class="element">
                    <a class="bouton" href="../panier/panier.php">Panier</a>
                    <a class="slide-out-blurred-top" href="../panier/panier.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
                        </svg>
                    </a>
                </div>
                <div class="element">
                    <a class="bouton" href="../compte/compte.php">Votre Compte</a>
                    <a class ="pulsate-fwd" href="../compte/compte.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
		<div id="section" method="post" action="../compte/connexionInscription.php">
			<div class="infos">
				<h1>Vos informations</h1>
				<p>Compte Administrateur</p>
				<p>Pseudonyme : <?php echo $pseudo; ?></p>
				<p>Mot de passe : <?php echo $mdp; ?></p>
				<p>Solde : <?php echo $solde . " €"; ?></p>
				<div class="ajout_article">
					<form id="section_form" method="post" action="../compte/venteArticle.html">
						<input class="souris5" type="submit"  value="Ajouter un article">
					</form>
				</div>
				<div class="bouton_conversation">
					<form id="section_form" method="post" action="../compte/listeChat.php">
						<input class="souris1" type="submit"  value="Voir les conversations">
					</form>
				</div>
				<div class="gerer_enchere">
					<form id="section_form" method="post" action="../parcourir/encherir.php">
						<input class="souris3" type="submit"  name="gerer" value="Gérer les enchères">
					</form>
				</div>
				<div class="gerer_vendeur">
					<form id="section_form" method="post" action="../compte/ajouterRetirerVendeur.php">
						<input class="souris2" type="submit"  value="Ajouter ou retirer des vendeurs">
					</form>
				</div>
				<div class="bouton_deconnexion">
					<input class="souris4" type="submit" value="Déconnexion" id="exit">
				</div>
			</div>
			<div class="articles">
				<h2>Article(s) en vente</h2>
				<div id="mesAchats">
					<?php
						$sql = "SELECT * FROM item WHERE Vendeur = '{$_SESSION['ID']}' ORDER BY ID DESC;";
						$result = mysqli_query($db_handle, $sql);
						if ($result) {
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									$Nom = $row['Nom'];
									$Categorie = $row['Categorie'];
									$ID = $row['ID'];
									$Prix = $row['Prix'];
									$typeVente = $row['TypeVente'];
									$photos = $row['Photo'];
									$photo = explode(",", $photos)[0];
									switch($Categorie) {
										case 'Meubles et objets d art':
											echo '
											<div class="article">
												<form name="suppr_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
													<table>
														<tr>
															<td class="identifiant"><strong>ID</strong></td>
															<td class="picture"><strong>Photo</strong></td>
															<td class="nom"><strong>Nom</strong></td>
															<td class="catego"><strong>Catégorie</strong></td>
															<td class="vente"><strong>Type de vente</strong></td>
															<td class="price"><strong>Prix</strong></td>
															<td class="bin"><strong>Supprimer</strong></td>
														</tr>
														<tr>
															<td class="identifiant">' . $ID . '</td>
															<td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
															<td class="nom">' . $Nom . '</td>
															<td class="catego">Meubles et objets d\'art</td>
															<td class="vente">' . $typeVente . '</td>
															<td class="price">' . $Prix . ' €</td>
															<td class="bin">
																<input id="hidenInput" type="hidden" name="ID_itemSuppr" value="' . $ID . '">
																<button class="bouton" type="submit" name="SupprimerArticle" value="Supprimer un article">
																	<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
																	<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
																	</svg>
																</button>
															</td>
														<tr>
													</table>
												</form>
											</div>';
										break;
										case 'Articles de luxe':
										echo '
											<div class="article">
												<form name="suppr_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
													<table>
														<tr>
															<td class="identifiant"><strong>ID</strong></td>
															<td class="picture"><strong>Photo</strong></td>
															<td class="nom"><strong>Nom</strong></td>
															<td class="catego"><strong>Catégorie</strong></td>
															<td class="vente"><strong>Type de vente</strong></td>
															<td class="price"><strong>Prix</strong></td>
															<td class="bin"><strong>Supprimer</strong></td>
														</tr>
														<tr>
															<td class="identifiant">' . $ID . '</td>
															<td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
															<td class="nom">' . $Nom . '</td>
															<td class="catego">Articles de luxe</td>
															<td class="vente">' . $typeVente . '</td>
															<td class="price">' . $Prix . ' €</td>
															<td class="bin">
																<input id="hidenInput" type="hidden" name="ID_itemSuppr" value="' . $ID . '">
																<button class="bouton" type="submit" name="SupprimerArticle" value="Supprimer un article">
																	<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
																	<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
																	</svg>
																</button>
															</td>
														<tr>
													</table>
												</form>
											</div>';
										break;
										case 'Articles réguliers':
										echo '
										<div class="article">
											<form name="suppr_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
												<table>
													<tr>
														<td class="identifiant"><strong>ID</strong></td>
														<td class="picture"><strong>Photo</strong></td>
														<td class="nom"><strong>Nom</strong></td>
														<td class="catego"><strong>Catégorie</strong></td>
														<td class="vente"><strong>Type de vente</strong></td>
														<td class="price"><strong>Prix</strong></td>
														<td class="bin"><strong>Supprimer</strong></td>
													</tr>
													<tr>
														<td class="identifiant">' . $ID . '</td>
														<td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
														<td class="nom">' . $Nom . '</td>
														<td class="catego">Articles réguliers</td>
														<td class="vente">' . $typeVente . '</td>
														<td class="price">' . $Prix . ' €</td>
														<td class="bin">
															<input id="hidenInput" type="hidden" name="ID_itemSuppr" value="' . $ID . '">
															<button class="bouton" type="submit" name="SupprimerArticle" value="Supprimer un article">
																<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
																<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
																</svg>
															</button>
														</td>
													<tr>
												</table>
											</form>
										</div>';
										break;
									}
								}
							} else {
								echo '<p align="center" id="vide">Aucun article</p>';
							}
							
						} else {
							echo mysqli_error($db_handle);
						}
					?>
				</div>
			</div>
		</div>
		<?php include '../footer/footer.html'; ?>
	</div>
	<script type="text/javascript">
		// jQuery Document
		$(document).ready(function () {
			$("#exit").click(function () {
				var exit = confirm("Voulez-vous vraiment vous déconnecter ?");
				if (exit == true) {
					window.location = "compte.php?logout=true";
				}
			});
		});
	</script>
	<?php
		mysqli_close($db_handle);
	?>
</body>
</html>
<?php
		break;
	case 'Vendeur':
		$nom = $_SESSION['Nom'];
		$prenom = $_SESSION['Prenom'];
		$pseudo = $_SESSION['Pseudo'];
		$mail = $_SESSION['Mail'];
		$mdp = $_SESSION['Mdp'];
		$photo = $_SESSION['Photo'];
		$fond = $_SESSION['Fond'];
		$solde = $_SESSION['Solde'];
		$cheminImage = "../img-compte/" . $photo;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../img-images/favicon.ico"/>
	<title>Votre Compte : Vendeur - Agora Francia</title>
	<link href="../styles.css" rel="stylesheet" type="text/css"/>
	<link href="../compte/compte.css" rel="stylesheet" type="text/css"/>
	<!-- Importation de Font Awesome via un lien CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.header').height($(window).height());
		});
	</script>
</head>
<body>
	<?php
	if (isset($_GET['logout'])) {
		session_destroy();
		sleep(1);
		header("Location: ../accueil/accueil.php");
		exit();
	}
	if (isset($_POST['SupprimerArticle'])) {
		$ID_itemSuppr = $_POST['ID_itemSuppr'];
		$sql = "DELETE FROM item WHERE ID = '$ID_itemSuppr';";
		$result = mysqli_query($db_handle, $sql);
	}
	?>
	<div id="wrapper">
        <div id="header">
            <h1>Agora</h1>
            <img class="rotation-horizontale" src="../img-images/logo.png" alt="Logo Agora Francia" height="100" width="100">
            <h1>Francia</h1>
        </div>
        <div id="nav">
            <div class="boutons-1-2">
                <a class="bouton" href="../accueil/accueil.php">Accueil</a>
                <a class="bouton" href="../parcourir/parcourir.php">Tout Parcourir</a>
            </div>
            <div class="boutons-3-4-5">
                <div class="element">
                    <a class="bouton" href="../notifications/notifications.php">Notifications</a>
                    <a class="wobble-hor-top" href="../notifications/notifications.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/>
                        </svg>
                    </a>
                </div>
                <div class="element">
                    <a class="bouton" href="../panier/panier.php">Panier</a>
                    <a class="slide-out-blurred-top" href="../panier/panier.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
                        </svg>
                    </a>
                </div>
                <div class="element">
                    <a class="bouton" href="../compte/compte.php">Votre Compte</a>
                    <a class ="pulsate-fwd" href="../compte/compte.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <?php if (isset($_POST['ajoutMur'])) {
			$file_name = $_FILES["PhotoMur"]["name"];
			$file_tmp = $_FILES["PhotoMur"]["tmp_name"];
			$file_size = $_FILES["PhotoMur"]["size"];
			$file_type = $_FILES["PhotoMur"]["type"];
			$target_dir = "../img-compte/";
			$target_file = $target_dir . $file_name;
			move_uploaded_file($file_tmp, $target_file);
			$target_file = mysqli_real_escape_string($db_handle, $target_file);
			$sql = "UPDATE vendeur SET Fond = '$target_file' WHERE ID = '{$_SESSION['ID']}';";
			$result = mysqli_query($db_handle, $sql);
		}
		$sql = "SELECT Fond FROM Vendeur WHERE ID = '{$_SESSION['ID']}';";
		$result = mysqli_query($db_handle, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$Fond = $row['Fond'];
			}
			if($Fond != '') {
				echo '<div id="sectionVendeur" style="background-image: url(' . $Fond . '); background-size: 100% 100%;" method="post">';
			}
			else {
				echo '<div id="sectionVendeur" style="background: linear-gradient(#c3edfd, white 10%);" method="post">';
			}
		}
		else {
			echo '<div id="sectionVendeur" style="background: linear-gradient(#c3edfd, white 10%);" method="post">';
		}
		?>
			<div class="infosVendeur">
				<h1 align="center">Vos informations</h1>
				<div class="info_en_plus">
					<div>
						<p>Compte Vendeur</p>
						<p>Nom : <?php echo $nom; ?></p>
						<p>Prénom : <?php echo $prenom; ?></p>
						<p>Pseudonyme : <?php echo $pseudo; ?></p>
						<p>Adresse email : <?php echo $mail; ?></p>
						<p>Mot de passe : <?php echo $mdp; ?></p>
						<p>Solde : <?php echo $solde . " €"; ?></p>
					</div>
					<!-- Modification de l'image de profil -->
					<div class="modification_pp">
						<?php if (isset($_POST['ajoutPhoto'])) {
								$file_name = $_FILES["Photo"]["name"];
								$file_tmp = $_FILES["Photo"]["tmp_name"];
								$file_size = $_FILES["Photo"]["size"];
								$file_type = $_FILES["Photo"]["type"];
								$target_dir = "../img-compte/";
								$target_file = $target_dir . $file_name;
								move_uploaded_file($file_tmp, $target_file);
								$target_file = mysqli_real_escape_string($db_handle, $target_file);
								$sql = "UPDATE vendeur SET Photo = '$target_file' WHERE ID = '{$_SESSION['ID']}';";
								$result = mysqli_query($db_handle, $sql);
							}
							$sql = "SELECT Photo FROM Vendeur WHERE ID = '{$_SESSION['ID']}';";
							$result = mysqli_query($db_handle, $sql);
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									$Photo = $row['Photo'];
								}
								echo '<img class="limit_img" src="' . $Photo.'" alt="Photo de profil" width = "100" height ="100">';
							}
							?>
						<form id="section_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
							<input id="photoField" type="file" name="Photo" required>
							<input class="souris7" type="submit" name="ajoutPhoto" value="Modifier image de profil" id="#">
						</form>
					</div>
				</div>
				<!-- Modification du mur -->
				<div class="modification_mur">
					<form id="section_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
						<input id="photoFieldMur" type="file" name="PhotoMur" required>
						<input class="souris6" type="submit" name="ajoutMur" value="Modifier mur" id="#">
					</form>
				</div>
				<div class="ajout_article">
					<form id="section_form" method="post" action="../compte/venteArticle.html">
						<input class="souris5" type="submit"  value="Ajouter un article">
					</form>
				</div>
				<div class="bouton_conversation">
					<form id="section_form" method="post" action="../compte/listeChat.php">
						<input class="souris1" type="submit"  value="Voir les conversations">
					</form>
				</div>
				<div class="bouton_deconnexion">
					<input class="souris4" type="submit" value="Déconnexion" id="exit">
				</div>
			</div>
			<div class="articlesVendeur">
				<h2>Article(s) en vente</h2>
				<div id="mesAchats">
					<?php
						$sql = "SELECT * FROM item WHERE Vendeur = '{$_SESSION['ID']}' ORDER BY ID DESC;";
						$result = mysqli_query($db_handle, $sql);
						if ($result) {
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									$Nom = $row['Nom'];
									$Categorie = $row['Categorie'];
									$ID = $row['ID'];
									$Prix = $row['Prix'];
									$typeVente = $row['TypeVente'];
									$photos = $row['Photo'];
									$photo = explode(",", $photos)[0];
									switch($Categorie) {
										case 'Meubles et objets d art':
											echo '
											<div class="articleVendeur">
												<form name="suppr_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
													<table>
														<tr>
															<td class="identifiant"><strong>ID</strong></td>
															<td class="picture"><strong>Photo</strong></td>
															<td class="nom"><strong>Nom</strong></td>
															<td class="catego"><strong>Catégorie</strong></td>
															<td class="vente"><strong>Type de vente</strong></td>
															<td class="price"><strong>Prix</strong></td>
															<td class="bin"><strong>Supprimer</strong></td>
														</tr>
														<tr>
															<td class="identifiant">' . $ID . '</td>
															<td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
															<td class="nom">' . $Nom . '</td>
															<td class="catego">Meubles et objets d\'art</td>
															<td class="vente">' . $typeVente . '</td>
															<td class="price">' . $Prix . ' €</td>
															<td class="bin">
																<input id="hidenInput" type="hidden" name="ID_itemSuppr" value="' . $ID . '">
																<button class="bouton" type="submit" name="SupprimerArticle" value="Supprimer un article">
																	<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
																	<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
																	</svg>
																</button>
															</td>
														<tr>
													</table>
												</form>
											</div>';
										break;
										case 'Articles de luxe':
										echo '
										<div class="articleVendeur">
											<form name="suppr_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
												<table>
													<tr>
														<td class="identifiant"><strong>ID</strong></td>
														<td class="picture"><strong>Photo</strong></td>
														<td class="nom"><strong>Nom</strong></td>
														<td class="catego"><strong>Catégorie</strong></td>
														<td class="vente"><strong>Type de vente</strong></td>
														<td class="price"><strong>Prix</strong></td>
														<td class="bin"><strong>Supprimer</strong></td>
													</tr>
													<tr>
														<td class="identifiant">' . $ID . '</td>
														<td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
														<td class="nom">' . $Nom . '</td>
														<td class="catego">Articles de luxe</td>
														<td class="vente">' . $typeVente . '</td>
														<td class="price">' . $Prix . ' €</td>
														<td class="bin">
															<input id="hidenInput" type="hidden" name="ID_itemSuppr" value="' . $ID . '">
															<button class="bouton" type="submit" name="SupprimerArticle" value="Supprimer un article">
																<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
																<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
																</svg>
															</button>
														</td>
													<tr>
												</table>
											</form>
										</div>';
										break;
										case 'Articles réguliers':
										echo '
										<div class="articleVendeur">
											<form name="suppr_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
												<table>
													<tr>
														<td class="identifiant"><strong>ID</strong></td>
														<td class="picture"><strong>Photo</strong></td>
														<td class="nom"><strong>Nom</strong></td>
														<td class="catego"><strong>Catégorie</strong></td>
														<td class="vente"><strong>Type de vente</strong></td>
														<td class="price"><strong>Prix</strong></td>
														<td class="bin"><strong>Supprimer</strong></td>
													</tr>
													<tr>
														<td class="identifiant">' . $ID . '</td>
														<td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
														<td class="nom">' . $Nom . '</td>
														<td class="catego">Articles réguliers</td>
														<td class="vente">' . $typeVente . '</td>
														<td class="price">' . $Prix . ' €</td>
														<td class="bin">
															<input id="hidenInput" type="hidden" name="ID_itemSuppr" value="' . $ID . '">
															<button class="bouton" type="submit" name="SupprimerArticle" value="Supprimer un article">
																<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
																<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
																</svg>
															</button>
														</td>
													<tr>
												</table>
											</form>
										</div>';
										break;
									}
								}
							} else {
								echo '<p align="center" id="vide">Aucun article</p>';
							}
							
						} else {
							echo mysqli_error($db_handle);
						}
					?>
				</div>
			</div>
		</div>
		<?php include '../footer/footer.html'; ?>
	</div>
	<script type="text/javascript">
		// jQuery Document
		$(document).ready(function () {
			$("#exit").click(function () {
				var exit = confirm("Voulez-vous vraiment vous déconnecter ?");
				if (exit == true) {
					window.location = "compte.php?logout=true";
				}
			});
		});
	</script>
	<?php
		mysqli_close($db_handle);
	?>
</body>
</html>
<?php
		break;
	case 'Acheteur':
		$nom = $_SESSION['Nom'];
		$prenom = $_SESSION['Prenom']; 
		$mail = $_SESSION['Mail'];
		$mdp = $_SESSION['Mdp']; 
		$adresse1 = $_SESSION['Adresse1']; 
		$adresse2 = $_SESSION['Adresse2'] ;
		$ville = $_SESSION['Ville'];
		$codepostal = $_SESSION['CodePostal'] ;
		$pays = $_SESSION['Pays'];
		$tel = $_SESSION['Tel']; 
		$typecarte = $_SESSION['TypeCarte'];
		$numcarte = $_SESSION['NumCarte']; 
		$nomcarte = $_SESSION['NomCarte'];
		$dateexp = $_SESSION['DateExp']; 
		$code = $_SESSION['Code']; 
		$solde = $_SESSION['Solde'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../img-images/favicon.ico"/>
	<title>Votre Compte : Acheteur - Agora Francia</title>
	<link href="../styles.css" rel="stylesheet" type="text/css"/>
	<link href="../compte/compte.css" rel="stylesheet" type="text/css"/>
	<!-- Importation de Font Awesome via un lien CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.header').height($(window).height());
		});
	</script>
</head>
<body>
	<?php
		if (isset($_GET['logout'])) {
			session_destroy();
			sleep(1);
			header("Location: ../accueil/accueil.php");
			exit();
		}
	?>
	<div id="wrapper">
        <div id="header">
            <h1>Agora</h1>
            <img class="rotation-horizontale" src="../img-images/logo.png" alt="Logo Agora Francia" height="100" width="100">
            <h1>Francia</h1>
        </div>
        <div id="nav">
            <div class="boutons-1-2">
                <a class="bouton" href="../accueil/accueil.php">Accueil</a>
                <a class="bouton" href="../parcourir/parcourir.php">Tout Parcourir</a>
            </div>
            <div class="boutons-3-4-5">
                <div class="element">
                    <a class="bouton" href="../notifications/notifications.php">Notifications</a>
                    <a class="wobble-hor-top" href="../notifications/notifications.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/>
                        </svg>
                    </a>
                </div>
                <div class="element">
                    <a class="bouton" href="../panier/panier.php">Panier</a>
                    <a class="slide-out-blurred-top" href="../panier/panier.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
                        </svg>
                    </a>
                </div>
                <div class="element">
                    <a class="bouton" href="../compte/compte.php">Votre Compte</a>
                    <a class ="pulsate-fwd" href="../compte/compte.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div id="section">
			<div class="infos">
				<form id="section_form" method="post" action="../compte/infoBancaire.html">
					<h1>Vos informations</h1>
					<p>Compte Acheteur</p>
					<p>Nom : <?php echo $nom; ?></p>
					<p>Prénom : <?php echo $prenom; ?></p>
					<p>Adresse email : <?php echo $mail; ?></p>
					<p>Mot de passe : <?php echo $mdp; ?></p>
					<p>Adresse 1 : <?php echo $adresse1; ?></p>
					<p>Adresse 2 : <?php echo $adresse2; ?></p>
					<p>Ville : <?php echo $ville; ?></p>
					<p>Code Postal : <?php echo $codepostal; ?></p>
					<p>Pays : <?php echo $pays; ?></p>
					<p>Téléphone : <?php echo $tel; ?></p>
					<p>Solde : <?php echo $solde . " €"; ?></p>
					<div class="info_perso">
						<input class="souris8" type="submit"  value="Saisir les informations personnelles">
					</div>
				</form>
				<div class="bouton_deconnexion">
					<input class="souris4" type="submit" value="Déconnexion" id="exit">
				</div>
			</div>
			<div class="articles">
				<h2>Article(s) achetés</h2>
				<div id="mesAchats">
					<?php
						$sql = "SELECT Achats FROM Acheteur WHERE ID = '{$_SESSION['ID']}'";
						$result = mysqli_query($db_handle, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							$mesAchats = $row['Achats'];
						}
						if (!empty($mesAchats)) {
							$mesAchats = explode(",", $mesAchats);
							foreach ($mesAchats as $achat) {
			                	$sql = "SELECT * FROM item WHERE ID = '$achat';";
								$result = mysqli_query($db_handle, $sql);
								if ($result) {
									while ($row = mysqli_fetch_assoc($result)) {
										$Nom = $row['Nom'];
										$Categorie = $row['Categorie'];
										$ID = $row['ID'];
										$Prix = $row['Prix'];
										$typeVente = $row['TypeVente'];
										$photos = $row['Photo'];
										$photo = explode(",", $photos)[0];
									}
									echo '
										<div class="article">
											<table>
												<tr>
													<td class="identifiant"><strong>ID</strong></td>
													<td class="picture"><strong>Photo</strong></td>
													<td class="nom"><strong>Nom</strong></td>
													<td class="vente"><strong>Type de vente</strong></td>
													<td class="price"><strong>Prix</strong></td>
												</tr>
												<tr>
													<td class="identifiant">' . $ID . '</td>
													<td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
													<td class="nom">' . $Nom . '</td>
													<td class="vente">' . $typeVente . '</td>
													<td class="price">' . $Prix . ' €</td>
												<tr>
											</table>
										</div>';
								} else {
									echo mysqli_error($db_handle);
									die();
								}
							}
						}
						else {
							echo '<p align="center" id="vide">Aucun article</p>';
						}
					?>
				</div>
			</div>
		</div>
		<?php include '../footer/footer.html'; ?>
	</div>
	<script type="text/javascript">
		// jQuery Document
		$(document).ready(function () {
			$("#exit").click(function () {
				var exit = confirm("Voulez-vous vraiment vous déconnecter ?");
				if (exit == true) {
					window.location = "compte.php?logout=true";
				}
			});
		});
	</script>
	<?php
		mysqli_close($db_handle);
	?>
</body>
</html>	
<?php
		break;
	}
?>

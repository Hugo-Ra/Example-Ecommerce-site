<?php
	session_start();
	$database = "piscine";
	$db_handle = mysqli_connect('localhost', 'root', '');
	$db_found = mysqli_select_db($db_handle, $database);
	$Nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
	$Prix = isset($_POST["Prix"]) ? $_POST["Prix"] : "";
	$Description = isset($_POST["Description"]) ? $_POST["Description"] : "";
	$Categorie = isset($_POST["Categorie"]) ? $_POST["Categorie"] : "";
	$typeVente = isset($_POST["typeVente"]) ? $_POST["typeVente"] : "";
	function reArrayFiles($file_post) {
		$file_array = array();
		$file_keys = array_keys($file_post);
		for ($i = 0; $i < count($file_post['name']); $i++) {
			foreach ($file_keys as $key) {
				$file_array[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_array;
	}
	// Si le bouton Mise en vente est cliqué
	if (isset($_POST["Ventes"])) {
		if ($db_found) {
			if (isset($_SESSION['Nom'])) {
				$vendeurNom = $_SESSION['Nom'];
				$sql = "SELECT ID FROM Vendeur WHERE Nom = '$vendeurNom'";
				$result = mysqli_query($db_handle, $sql);
				$vendeur = mysqli_fetch_assoc($result)['ID'];
			} else {
				$vendeur = 0;
			}
			$Nom = mysqli_real_escape_string($db_handle, $Nom);
			$Description = mysqli_real_escape_string($db_handle, $Description);
			if (isset($_FILES['Photo']) && !empty($_FILES['Photo']['name'])) {
				$file_array = reArrayFiles($_FILES['Photo']);
				$file_name_photos = array();
				foreach ($file_array as $file) {
					$file_name = $file['name'];
					$file_tmp = $file['tmp_name'];
					$file_size = $file['size'];
					$file_type = $file['type'];
					$target_dir = "../img-articles/";
					$target_file = $target_dir . $file_name;
					move_uploaded_file($file_tmp, $target_file);
					$file_name_photos[] = $file_name;
				}
				$file_name = '';
				foreach ($file_name_photos as $name) {
					$file_name .= mysqli_real_escape_string($db_handle, $name) . ',';
				}
				$file_name = rtrim($file_name, ",");
			} else {
				echo "Erreur : une erreur s'est produite lors du téléchargement de la photo.";
			}
			if($typeVente == 'Encheres') {
				$val = $_SESSION['ID'] . ',' . $Prix;
			}
			$sql = "INSERT INTO item (`ID`, `Nom`, `Prix`, `Photo`, `Video`, `Description`, `Categorie`, `TypeVente`, `Vendeur`, `Etat`, `ValeurEnchere`) VALUES (NULL, '$Nom', '$Prix', '$file_name', '', '$Description', '$Categorie', '$typeVente', '$vendeur', 1, '$val');";
			$result = mysqli_query($db_handle, $sql);
		} else {
			echo "<br>Base de données non trouvée";
		}
	}
	header('Location: ../accueil/accueil.php');
	mysqli_close($db_handle);
?>

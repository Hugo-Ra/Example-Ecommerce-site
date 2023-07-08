<?php
	session_start();
    $database = "piscine";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    if ($db_found) {
		if (isset($_POST['Terminer'])) {
			$ID_article = $_POST['ID_item'];
			$sql = "SELECT Vendeur, ValeurEnchere FROM Item WHERE ID = '$ID_article';";
			$result = mysqli_query($db_handle, $sql);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$ID_vendeur = $row['Vendeur'];
					$vals = $row['ValeurEnchere'];
					$vals = explode(',', $vals);
				}
				$ID_acheteur = $vals[2];
				$final_price = intval($vals[1]) + 1;
				$sql = "SELECT Solde FROM Acheteur WHERE ID = '$ID_acheteur';";
				$result = mysqli_query($db_handle, $sql);
				if ($result) {
					while ($row = mysqli_fetch_assoc($result)) {
						$solde = $row['Solde'];
					}
					$solde -= $final_price;
					$sql = "SELECT Achats FROM Acheteur WHERE ID = '$ID_acheteur';";
					$result = mysqli_query($db_handle, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						$mesAchats = $row['Achats'];
					}
					if (!empty($mesAchats)) {
						$achat = ',' . $ID_article;
					}
					else {
						$achat = $ID_article;
					}
					$sql = "UPDATE Acheteur SET Solde = '$solde', Achats = CONCAT(Achats, '$achat') WHERE ID = '$ID_acheteur';";
					$result = mysqli_query($db_handle, $sql);
					$sql = "UPDATE Vendeur SET Solde = Solde + '$final_price' WHERE ID = '$ID_vendeur';";
					$result = mysqli_query($db_handle, $sql);
					$sql = "UPDATE Item SET Etat = 0, Vendeur = -1 WHERE ID = '$ID_article';";
					$result = mysqli_query($db_handle, $sql);
					$sql = "DELETE FROM conversation WHERE Item = '$ID_article';";
					$result = mysqli_query($db_handle, $sql);
					header('Location: ../compte/compte.php');
					exit();
				} else {
					echo "pb lors de l'exécution de la requête SQL";
				}
				
			} else {
				echo "pb lors de l'exécution de la requête SQL";
			}
		}
    }
?>
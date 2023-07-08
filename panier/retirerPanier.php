<?php
	session_start();
	$ID_article = $_POST['envoieID_item'];
	$article = array_search($ID_article, $_SESSION['panier']);
	if ($article !== false) {
		unset($_SESSION['panier'][$article]);
	}
	$database = "piscine";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    if($db_found) {
		$sql = "UPDATE item SET Etat = 1 WHERE ID = '$ID_article';";
		$result = mysqli_query($db_handle, $sql);
		header('Location: ../panier/panier.php');
		exit();
	}
?>
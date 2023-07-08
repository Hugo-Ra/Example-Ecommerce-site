<?php
	session_start();
	$statut = $_SESSION['Statut'];
	$_SESSION['first'] = true;
	if ($statut == 'Admin' || $statut == 'Vendeur') {
		$ID_P2 = $_SESSION['ID_P2'];
		$ID_P1 = $_SESSION['ID'];
		$msg = $_POST['message'];
		switch($statut) {
			case 'Admin':
				$user = 'Admin';
				break;
			case 'Vendeur':
				$user = $_SESSION['Pseudo'];
				break;
		}
		$database = "piscine";
		$db_handle = mysqli_connect('localhost', 'root', '');
		$db_found = mysqli_select_db($db_handle, $database);
		if ($db_found) {
			$final_msg = "<div class='msg'><span class='chat-time'>" . date("g:i A") . "</span> <b class='user'>" . mysqli_real_escape_string($db_handle, $user) . "</b> " . mysqli_real_escape_string($db_handle, stripslashes(htmlspecialchars($msg))) . "<br></div>";
			$sql = "UPDATE conversation SET Chat = CONCAT(Chat, '" . mysqli_real_escape_string($db_handle, $final_msg) . "') WHERE ID_P1 = '$ID_P1' AND ID_P2 = '$ID_P2';";
			$result = mysqli_query($db_handle, $sql);
			if (!$result) {
				echo mysqli_error($db_handle);
				die();
			}
			header("Location: ../parcourir/chatroom.php");
			exit();
			mysqli_close($db_handle);
		}
	} else {
		$ID_P2 = $_SESSION['ID'];
		$ID_P1 = $_SESSION['ID_P1'];
		$msg = $_POST['message'];
		$user = $_SESSION['Prenom'] . " " . $_SESSION['Nom'];
		$database = "piscine";
		$db_handle = mysqli_connect('localhost', 'root', '');
		$db_found = mysqli_select_db($db_handle, $database);
		if ($db_found) {
			$final_msg = "<div class='msg'><span class='chat-time'>" . date("g:i A") . "</span> <b class='user'>" . mysqli_real_escape_string($db_handle, $user) . "</b> " . mysqli_real_escape_string($db_handle, stripslashes(htmlspecialchars($msg))) . "<br></div>";
			$sql = "UPDATE conversation SET Chat = CONCAT(Chat, '" . mysqli_real_escape_string($db_handle, $final_msg) . "') WHERE ID_P1 = '$ID_P1' AND ID_P2 = '$ID_P2';";
			$result = mysqli_query($db_handle, $sql);
			if (!$result) {
				echo mysqli_error($db_handle);
				die();
			}
			header("Location: ../parcourir/chatroom.php");
			exit();
			mysqli_close($db_handle);
		}
	}
?>

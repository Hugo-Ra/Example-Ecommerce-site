<?php
	$ID = $_POST['ID'];
    $database = "piscine";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    if ($db_found) {
    	$sql = "SELECT * FROM item WHERE ID = '$ID';";
        $result = mysqli_query($db_handle, $sql);
        if ($result) {
            $info = mysqli_fetch_assoc($result);
            echo json_encode($info);
        } else {
            echo "pb lors de l'exécution de la requête SQL";
        }
    }
?>
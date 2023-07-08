<?php
    session_start();
    $_SESSION['first'] = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exit']) && $_POST['exit'] === 'Retour') {
        header("Location: ../compte/compte.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../compte/listeChat.css" />
    <title>Liste Chat</title>
    <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
    <link href="../compte/listeChat.css" rel="stylesheet" type="text/css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Palanquin+Dark&display=swap');
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $ID_vendeur = $_SESSION['ID'];
        $database = "piscine";
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);
        if ($db_found) {
    ?>
    <div id="wrapper">
        <div id="menu">
        <div id="titre">
            <h1>Liste des Chats</h1>
        </div>

        </div><br>
        <div id="listeChat">
            <?php
                $sql = "SELECT * FROM Conversation WHERE ID_P1 = '$ID_vendeur';";
                $result1 = mysqli_query($db_handle, $sql);
                if ($result1) {
                    if (mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $ID_acheteur = $row1['ID_P2'];
                            $ID_article = $row1['Item'];
                            $sql2 = "SELECT Nom, Prenom FROM Acheteur WHERE ID = '$ID_acheteur';";
                            $result2 = mysqli_query($db_handle, $sql2);
                            if ($result2) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    $Nom = $row2['Nom'];
                                    $Prenom = $row2['Prenom'];
                                }
                                $sql3 = "SELECT Nom, Photo FROM Item WHERE ID = '$ID_article';";
                                $result3 = mysqli_query($db_handle, $sql3);
                                if ($result3) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $photos = $row3['Photo'];
                                        $photo = explode(",", $photos)[0];
                                        $nom_article = $row3['Nom'];
                                    }
                                    echo '
                                    <div id="informations">
                                        <form id="vendeur" method="post" action="../parcourir/chatroom.php">
                                                <label>
                                                
                                                <table>
                                                    <tr>
                                                        <th> Photo </th>
                                                        <th> Nom de l\'article </th>
                                                        <th> Conversation avec : </th>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="laPhoto"><img src="../img-articles/' . $photo . '" id="photo" class="img-panier"></div></td><td>      ' . $nom_article . '</td>

                                                        <input id="envoieID" type="hidden" name="envoieID" value="' . $ID_acheteur . '">

                                                        <td><div class="personne"><p>' . $Prenom . " " . $Nom . '</p></div><div class="voirConv"><input class="souris19" type="submit" value="Accéder"></div></td>
                                                    </tr>
                                                </table>
    
                                                <input id="envoieID_article" type="hidden" name="envoieID_article" value="' . $ID_article . '">

                                                </label>
                                                
                                        </form>
                                    </div>';
                                } else {
                                    echo "pb lors de l'exécution de la requête SQL3";
                                }
                            } else {
                                echo "pb lors de l'exécution de la requête SQL2";
                            }
                        }
                    } else {
                        echo '<p id="errror" align="center"><b>Aucune conversation disponible</b></p>';
                    }
                    
                } else {
                    echo "pb lors de l'exécution de la requête SQL";
                }
            ?>
        </div>
        <div id="retour">
            <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input class="souris18" type="submit" name="exit" value="Retour">
            </form>
        </div>
    </div>
    <?php
        mysqli_close($db_handle);
        }
    ?>
</body>
</html>

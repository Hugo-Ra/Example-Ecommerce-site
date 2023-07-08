<?php
    session_start();
    $statut = $_SESSION['Statut'];
    if ($statut == 'Admin' || $statut == 'Vendeur') {
        if (!$_SESSION['first']) {
            $_SESSION['ID_article'] = $_POST['envoieID_article'];
            $_SESSION['ID_P2'] = $_POST['envoieID'];
            $_SESSION['first'] = true;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exit']) && $_POST['exit'] === 'Quitter la conversation') {
            $_SESSION['first'] = false;
            header("Location: ../compte/listeChat.php");
            exit();
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Chatroom</title>
    <link rel="stylesheet" href="../parcourir/chatroom.css" />
    <!--<link href="../parcourir/chatroom.css" rel="stylesheet" type="text/css"/>-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&family=Palanquin+Dark&family=Roboto+Slab&display=swap');
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $ID_vendeur = $_SESSION['ID'];
        $ID_acheteur = $_SESSION['ID_P2'];
        $ID_article = $_SESSION['ID_article'];
        $database = "piscine";
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);
        if ($db_found) {
            if (isset($_POST['offreAcheteur'])) {
                $choix = $_POST['offreAcheteur'];
                if ($choix == 'Accepter')
                {
                    $sql = "SELECT Offre FROM Conversation WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article';";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $offreAcheteur = $row['Offre'];
                        }
                        $sql = "SELECT Solde FROM Acheteur WHERE ID = '$ID_acheteur';";
                        $result = mysqli_query($db_handle, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $solde = $row['Solde'];
                            }
                            $solde -= $offreAcheteur;
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
                            $sql = "UPDATE Vendeur SET Solde = Solde + '$offreAcheteur' WHERE ID = '$ID_vendeur';";
                            $result = mysqli_query($db_handle, $sql);
                            $sql = "UPDATE Item SET Etat = 0, Vendeur = -1 WHERE ID = '$ID_article';";
                            $result = mysqli_query($db_handle, $sql);
                            $sql = "DELETE FROM conversation WHERE Item = '$ID_article';";
                            $result = mysqli_query($db_handle, $sql);
                            header('Location: ../compte/listeChat.php');
                            exit();
                        } else {
                            echo "pb lors de l'exécution de la requête SQL";
                        }
                        
                    } else {
                        echo "pb lors de l'exécution de la requête SQL";
                    }
                }
                else {
                    $sql = "UPDATE Conversation SET Offre = 0 WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article';";
                    $result = mysqli_query($db_handle, $sql);
                    if (!$result) {
                        echo mysqli_error($db_handle);
                        die();
                    }
                    $_POST['message'] = 'A decliné votre offre';
                    include('traitementChatroom.php');
                }
            }
    ?>
    <div id="wrapper">
        <div id="titre">
            <h1>Chat Vendeur</h1>
        </div>
        <div id="chatbox">
            <div id="text-chatbox">
                <div id='chat'>
                <?php
                    $sql = "SELECT Chat FROM Conversation WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article'";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                                $chat = $row['Chat'];
                            }
                            echo $chat;
                            
                    } else {
                        echo "pb lors de l'exécution de la requête SQL";
                    }
                ?>
                </div>
            </div>
        </div>
        <div id="offre">
            <?php
                $sql = "SELECT Offre FROM Conversation WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article'";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $offre = $row['Offre'];
                        }
                        if ($offre != 0) {
                            echo '<p><b>Offre de ' . $offre . ' €</b></p>
                                    <form name="offre_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
                                    <div class="choixOffre">
                                        <input class="souris24" type="submit" name="offreAcheteur" value="Accepter">
                                        <input class="souris25" type="submit" name="offreAcheteur" value="Refuser">
                                    </div>
                                    </form>';
                        }
                    }
                    
                } else {
                    echo "pb lors de l'exécution de la requête SQL";
                }
            ?>
        </div>
        <div id="envoyer">
            <form name="msg" method="post" action="traitementChatroom.php">
                <div class="faireOffre">
                <div class=conv>
                    <input name="message" type="text" id="message" />
                </div>
                <div class="envoyerbouton">
                <input class="souris2" type="submit" value="Envoyer" />
                </div>
            </div>
            </form>
        </div>
        <div id="retour">
            <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="quitter">
                    <input class="souris3" type="submit" name="exit" value="Quitter la conversation"><br>
                </div>
            </form>
        </div>
    </div>
    <?php
        mysqli_close($db_handle);
        }
    ?>
</body>
</html>
<?php 
    } else {
        if (!$_SESSION['first']) {
            $_SESSION['ID_article'] = $_POST['envoieID_article'];
            $_SESSION['ID_P1'] = $_POST['envoieID'];
            $_SESSION['first'] = true;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exit']) && $_POST['exit'] === 'Quitter la conversation') {
            $_SESSION['first'] = false;
            header("Location: ../parcourir/parcourir.php");
            exit();
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Chatroom</title>
    <link rel="stylesheet" href="chatroom.css" />
    <!--<link href="../parcourir/chatroom.css" rel="stylesheet" type="text/css"/>-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&family=Palanquin+Dark&family=Roboto+Slab&display=swap');
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $ID_vendeur = $_SESSION['ID_P1'];
        $ID_acheteur = $_SESSION['ID'];
        $ID_article = $_SESSION['ID_article'];
        $database = "piscine";
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);
        if ($db_found) {
            if (isset($_POST['offre'])) {
                $valeur_offre = $_POST['valeur_offre'];
                $sql = "SELECT ID, Compteur FROM Conversation WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article';";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ID_conv = $row['ID'];
                        $compteur = $row['Compteur'];
                    }
                    
                } else {
                    echo "pb lors de l'exécution de la requête SQL";
                }
                if ($compteur < 5)
                {
                    $sql = "UPDATE conversation SET Compteur = Compteur + 1, Offre = '$valeur_offre' WHERE ID = '$ID_conv';";
                    $result = mysqli_query($db_handle, $sql);
                    if (!$result) {
                        echo mysqli_error($db_handle);
                    }
                }
                else {
    ?>
                    <script type='text/javascript'>
                        alert('Vous avez effectué le nombre maximum d\'offre');
                    </script>
    <?php
                }
            }
    ?>
    <div id="wrapper">
        <div id="titre">
            <h1>Chat Acheteur</h1>
        </div>
        <div id="menu">
            <div id="text-chatbox">
                <?php
                    $sql = "SELECT Chat FROM Conversation WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article';";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $chat = $row['Chat'];
                            }
                            echo $chat;
                        } else {
                            $sql = "INSERT INTO conversation (`ID`, `Chat`, `ID_P1`, `ID_P2`, `Item`) VALUES (NULL, '', '$ID_vendeur', '$ID_acheteur', '$ID_article');";
                            $result = mysqli_query($db_handle, $sql);
                            if (!$result) {
                                echo "pb lors de l'exécution de la requête SQL 2";
                            }
                        }
                        
                    } else {
                        echo "pb lors de l'exécution de la requête SQL";
                    }
                ?>
                <?php
                    $sql = "SELECT Offre FROM Conversation WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article';";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $offre = $row['Offre'];
                            }
                            if ($offre != 0) {
                                echo '
                                <div id="offre">
                                    <p><b>Offre de ' . $offre . ' €</b></p>
                                </div>';
                            }
                        }
                        
                    } else {
                        echo "pb lors de l'exécution de la requête SQL";
                    }
                ?>
                <div id="envoyer">
                    <form name="msg" method="post" action="traitementChatroom.php">
                        <div class="faireOffre">
                            <input name="message" type="text" id="message" />

                            <div class="envoyerbouton">
                                <input class="souris2" type="submit" value="Envoyer message" />
                            </div>
                        </div>
                    </form>
                </div>
                <div id="faire-offre">
                    <form id="offre_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="faireOffre">
                        <input type="text" name="valeur_offre">
                        <div class="offre">
                            <input class="souris13" type="submit" name="offre" value="Faire une offre">
                        </div>
                    </div>
                        <?php
                            $sql = "SELECT Compteur FROM Conversation WHERE ID_P1 = '$ID_vendeur' AND ID_P2 = '$ID_acheteur' AND Item = '$ID_article';";
                            $result = mysqli_query($db_handle, $sql);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $comp = 5 - $row['Compteur'];
                                    }
                                    echo'<p id="nbOffre">Nombre d\'offre restante : ' . $comp . '</p>';
                                }
                                
                            } else {
                                echo "pb lors de l'exécution de la requête SQL";
                            }
                        ?>
                    </form>
                </div>
        </div>
    </div>
    <div id="retour">
        <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="quitter">
                <input class="souris3" type="submit" name="exit" value="Quitter la conversation">
            </div>
        </form>
    </div>
    <?php
        mysqli_close($db_handle);
        }
    ?>
</body>
</html>
<?php } ?>
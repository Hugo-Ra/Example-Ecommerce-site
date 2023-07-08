<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exit']) && $_POST['exit'] === 'Retour') {
        header("Location: ../compte/compte.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Liste Chat</title>
    <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
    <link href="../compte/ajouterRetirerVendeur.css" rel="stylesheet" type="text/css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Palanquin+Dark&display=swap');
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $database = "piscine";
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);
        if ($db_found) {
            if (isset($_POST['SupprimerVendeur'])) {
                $ID_vendeurSuppr = $_POST['ID_vendeurSuppr'];
                $sql = "DELETE FROM vendeur WHERE ID = '$ID_vendeurSuppr';";
                $result = mysqli_query($db_handle, $sql);
            }
            if (isset($_POST['AjouterVendeur'])) {
                header('Location: ../compte/ajouterVendeur.php');
                exit();
            }
    ?>
    <div id="wrapper">
        <div id="titre"><h1>Liste des vendeurs</h1></div>
        <div id="listeChat">

            <?php
                $sql = "SELECT * FROM Vendeur;";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $Nom = $row['Nom'];
                            $Prenom = $row['Prenom'];
                            $Pseudo = $row['Pseudo'];
                            $Mail = $row['Mail'];
                            $Photo = $row['Photo'];
                            echo '
                            <table>
                                <tr>

                                    <th>Photo</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Pseudo</th>
                                    <th>Mail</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><div class="photophoto"><img id="photo" src="../img-articles/' . $Photo . '"  class="img-panier"></div></td>
                                    <td><b>' . $Nom . '</b></td>
                                    <td><b>' . $Prenom . '</b></td>
                                    <td>' . $Pseudo . '</td>
                                    <td>' . $Mail . '</td>
                                    <td>
                                        <form name="suppr_form" method="post" action="' . $_SERVER['PHP_SELF'] . '">
                                            <input class="gerer_enchere" id="hidenInput" type="hidden" name="ID_vendeurSuppr" value="' . $ID . '">
                                            <div class="sup">
                                            <input class="souris1" type="submit" name="SupprimerVendeur" value="Supprimer ce vendeur">
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </table>';
                        }
                    } else {
                        echo '<p>Il n\'y a aucun vendeur</p>';
                    }
                } else {
                    echo "pb lors de l'exécution de la requête SQL";
                }
            ?>
            <div id="#">
                <form name="ajout_form" method="post" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="ajout">
                    <input class="souris2" type="submit" name="AjouterVendeur" value="Ajouter un vendeur">
                    </div>
                </form>
            </div>
            
        </div>
        <div id="retour">
            <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="retour">
                <input class="souris3" type="submit" name="exit" value="Retour">
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

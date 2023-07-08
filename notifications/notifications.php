<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../img-images/favicon.ico"/>
    <title>Tout Parcourir - Agora Francia</title>
    <link href="../styles.css" rel="stylesheet" type="text/css"/>
    <link href="../notifications/notifications.css" rel="stylesheet" type="text/css"/>
    <!-- Importation de Font Awesome via un lien CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>
    <?php
        $database = "piscine";
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);
        if ($db_found) {
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
        <?php
        if ($_SESSION['Statut'] == 'Acheteur') {
        ?>
        <?php
            if (isset($_POST['terminer'])) {
                $categorie = $_POST['categorie'];
                $activation = $_POST['Activation'];
                if(!empty($activation)) {
                    $sql = "SELECT MAX(ID) AS maxID FROM item";
                    $result = mysqli_query($db_handle, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ID = $row['maxID'];
                    }
                    $sql = "INSERT INTO notif (ID, ID_Acheteur, Debut, Categorie) VALUES (NULL, '{$_SESSION['ID']}', '$ID', '$categorie');";
                    $result = mysqli_query($db_handle, $sql);
                }
            }
            if (isset($_POST['changer'])) {
                $sql = "DELETE FROM notif WHERE ID_Acheteur = '{$_SESSION['ID']}';";
                $result = mysqli_query($db_handle, $sql);
            }
        ?>
        <h1>Notifications</h1>
        <?php
            $sql = "SELECT * FROM notif WHERE ID_Acheteur = '{$_SESSION['ID']}'";
            $result = mysqli_query($db_handle, $sql);
            if (!(mysqli_num_rows($result) > 0)) {
        ?> 
        <form id="myForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="full_button">
                <div class="alerte">
                    <label for="Activation"><strong>Activer les notifications</strong></label>
                    <input type="checkbox" name="Activation" value="yes" required>
                </div>
                <div class="catego">
                    <input type="radio" name="categorie" value="Meubles et objets d art" required>
                    <label for="article1">Meubles et objets d'art</label>
                    <input type="radio"  name="categorie" value="Articles de luxe">
                    <label for="article2">Articles de luxe</label>
                    <input type="radio"  name="categorie" value="Articles réguliers">
                    <label for="article3">Articles réguliers</label>
                </div>
            </div>
            <div class="bouton_valider">
                <input class="souris" type="submit" name="terminer" value="Valider"> 
            </div>
        </form>
        <?php
            } else {
        ?>
        <?php
                $sql = "SELECT * FROM notif WHERE ID_Acheteur = '{$_SESSION['ID']}'";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $Choix = $row['Categorie'];
                        $Debut = $row['Debut'];
                    }
                    $sql = "SELECT ID, Nom, TypeVente, Categorie, Prix, Photo FROM item";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) {
                        $a=0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $Categorie = $row['Categorie'];
                            if($ID > $Debut && $Choix == $Categorie) {
                                $a = 1;
                                $Nom = $row['Nom'];
                                $Prix = $row['Prix'];
                                $TypeVente = $row['TypeVente'];
                                $photos = $row['Photo'];
                                $Photo = explode(",", $photos)[0];
                                echo '
                                    <div class="line">
                                        <table>
                                            <tr>
                                                <td class="sentence">L\'article ' . $Nom . ' (ID: ' . $ID . ') est désormais disponible dans les ' . $TypeVente . ', en section ' . $Categorie . ' pour le prix de ' . $Prix . ' €.</td>
                                                <td class="picture"><img class="limit_img" id="image_article" src="../img-articles/' . $Photo . '"></td>
                                            </tr>
                                        </table>
                                    <div>';
                            }
                        }
                    } else {
                        echo mysqli_error($db_handle);
                    }
                } else {
                    echo mysqli_error($db_handle);
                }
                if($a == 0) {
                    echo '<p align="center "id="error">Il n\'y a pas de nouveaux articles dans cette catégorie pour le moment.</p>';
                }
        ?>          
        <div class="choix">
            <form id="changer" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input class="souris1" type="submit" name="changer" value="Changer de catégorie d'articles"> 
            </form>
        </div>
        <?php
            }
        }
        else {
            echo '<p align="center "id="error"><b>Notifications indisponibles<b></p>';
        }
        ?>
        </div>
        <?php include '../footer/footer.html'; ?>
    </div>
<?php } ?>
</body>
</html>

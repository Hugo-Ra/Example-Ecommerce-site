<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../img-images/favicon.ico"/>
    <title>Panier - Agora Francia</title>
    <link href="../styles.css" rel="stylesheet" type="text/css"/>
    <link href="../panier/panier.css" rel="stylesheet" type="text/css"/>
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
            <h1>Panier</h1>
            <?php
                if (empty($_SESSION['panier'])) {
                    echo "<p id=error>Votre panier est vide</p>";
                } else {
                    foreach ($_SESSION['panier'] as $item) {
                        $sql = "SELECT * FROM item WHERE ID = '$item';";
                        $result = mysqli_query($db_handle, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $photos = $row['Photo'];
                                $photo = explode(",", $photos)[0];
                                $nom = $row['Nom'];
                                $desc = $row['Description'];
                                $prix = $row['Prix'];
                                echo'<div class="full_article">
                                        <div class="article">
                                            <form id="retirerPanier" method="POST" action="../panier/retirerPanier.php">
                                                <table>
                                                    <tr>
                                                        <td class="picture"><strong>Photo</strong></td>
                                                        <td class="nom"><strong>Nom</strong></td>
                                                        <td class="descr"><strong>Description</strong></td>
                                                        <td class="price"><strong>Prix</strong></td>
                                                        <td class="bin"><strong>Supprimer</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="picture"><img class="limit_img" src="../img-articles/' . $photo . '" alt="Photo Article"></td>
                                                        <td class="nom">' .  $nom . '</td>
                                                        <td class="desc">' . $desc . '</td>
                                                        <td class="price">' . $prix . ' €</td>
                                                        <td class="bin">
                                                            <input id="envoieID_item" type="hidden" name="envoieID_item" value="' .  $item . '">
                                                            <button type="submit" name="retirer">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                                                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>';
                            }
                        } else {
                            echo mysqli_error($db_handle);
                        }
                    }
            ?>
            <div id="paiement">
                <?php
                    if (!empty($_SESSION['panier'])) {
                        $prix_total = 0;
                        foreach ($_SESSION['panier'] as $item) {
                            $sql = "SELECT Prix FROM item WHERE ID = '$item';";
                            $result = mysqli_query($db_handle, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $prix_total += $row['Prix'];
                                }
                            } else {
                                echo mysqli_error($db_handle);
                            }
                        }
                        echo '<div class="total">
                                    <p id="total">Sous-total (HT) : ' . $prix_total*0.9 . '€</p>
                                    <p>(Taux de TVA à 10%)</p><br>
                                    <p id="total"><strong>Total (TTC) : ' . $prix_total . '€</strong></p>
                            </div>';
                    }
                    $sql = "SELECT * FROM Acheteur WHERE NumCarte = '' AND ID = '{$_SESSION['ID']}';";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) {
                        if (!(mysqli_num_rows($result) > 0)) {
                ?>
                            <div class="payer">
                                <form id="paiement" method="post" action="../panier/paiement.php">
                                    <input type="submit"  value="Procéder au paiement">
                                </form>
                            </div>
                <?php
                        } else {
                ?>
                <div class="payer">
                    <form id="paiement" method="post" action="../compte/infoBancaire.html">
                        <input type="submit"  value="Saisir vos informations personnelles">
                    </form>
                </div>
                <?php
                        }
                    } else {
                        echo mysqli_error($db_handle);
                    }
                ?>
            </div>
                <?php
            }
        }
        else {
            echo '<p align="center "id="error"><b>Panier indisponible<b></p>';
        }
            ?>
        </div>
        <?php include '../footer/footer.html'; ?>
    </div>
<?php } ?>
</body>
</html>

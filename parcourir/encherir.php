<?php
    session_start();
    $database = "piscine";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exit']) && $_POST['exit'] === 'Retour') {
        header("Location: ../compte/compte.php");
        exit();
    }
    if (isset($_POST['gerer'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Liste Enchere</title>
    <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
    <link href="../parcourir/encherir.css" rel="stylesheet" type="text/css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&family=Palanquin+Dark&family=Roboto+Slab&display=swap');
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
    ?>
    <div id="wrapper">
        <div id="titre"><h1>Liste des enchères</h1></div>
        <br>
        <div id="listeChat">
            <?php
                $sql = "SELECT ID, Nom, Photo, Prix, ValeurEnchere, Etat FROM Item WHERE TypeVente = 'Encheres';";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $a=0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $Photos = $row['Photo'];
                            $Photo = explode(",", $Photos)[0];
                            $Nom = $row['Nom'];
                            $Prix = $row['Prix'];
                            $enchere = $row['ValeurEnchere'];
                            $etat = $row['Etat'];
                            $vals = explode(',', $enchere);
                            if (count($vals) == 4 && $etat != 0)
                            {
                                $a=1;
                                $montant = $vals[3];
                                echo '
                                
                                <form name="suppr_form" method="post" action="../parcourir/paiementEnchere.php">
                                    <table>
                                        <tr>
                                            <th> Photo </th>
                                            <th> Nom du produit </th>
                                            <th> Montant pré-enchère </th>
                                            <th> Montant post-enchère </th>

                                        </tr>
                                        <tr>
                                            
                                                <td>
                                                    <div class="photophoto"><img id="photo" src="../img-articles/' . $Photo . '" alt="Photo Article"></div>
                                                </td>
                                          
                                            <td >'. $Nom . '</td> 
                                            <td >'. $Prix . ' €</td>
                                            <td >' . $montant . ' €</td>
                                            
                                                
                                        </tr>
                                    </table>
                                            <div class="term">
                                                <input class="souris1" type="submit" name="Terminer" value="Terminer cette enchère" id="terminer">
                                            </div>
                                        
                                    <input id="hidenInput" type="hidden" name="ID_item" value="' . $ID . '">
                                            
                                </form><br><br>';
                            }
                            
                        }
                        if($a==0)
                        {
                            echo '<p class="pas" align="center"><b>Aucune enchère disponible</b></p>';
                        }
                    } else {
                        echo '<p class="pas" align="center"><b>Aucune enchère disponible</b></p>';
                    }
                    
                } else {
                    echo "pb lors de l'exécution de la requête SQL";
                }
            ?>
        </div>
        <div id="menu">
            <div id="retour">
                <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="sortir">
                    <input class="souris2" type="submit" name="exit" value="Retour">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        mysqli_close($db_handle);
        }
    ?>
</body>
</html>
<?php
    }
    if (isset($_POST['encherir'])) {
        $valeur_offre = $_POST['montant'];
        $item = $_POST['envoieID_item'];
        $sql = "SELECT Prix, ValeurEnchere FROM Item WHERE ID = '$item';";
        $result = mysqli_query($db_handle, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $vals = $row['ValeurEnchere'];
                $prix = $row['Prix'];
            }
            if(!($valeur_offre < $prix)) {
                if(empty($vals))
                {
                    $vals = $_SESSION['ID'] . ',' . $valeur_offre;
                    $sql = "UPDATE item SET ValeurEnchere = '$vals' WHERE ID = '$item';";
                    $result = mysqli_query($db_handle, $sql);
                }
                else {
                    $vals = explode(',', $vals);
                    if (count($vals) == 4)
                    {
                        if ($valeur_offre > $vals[3])
                        {
                            $vals = $vals[2] . ',' . $vals[3] . ',' . $_SESSION['ID'] . ',' . $valeur_offre;
                        }
                        else if ($valeur_offre > $vals[1])
                        {
                            $vals =  $_SESSION['ID'] . ',' . $valeur_offre . ',' . $vals[2] . ',' . $vals[3];
                        }
                        else {
                            $vals =  $vals[0] . ',' . $vals[1] . ',' . $vals[2]. ',' . $vals[3];
                        }
                    }
                    else {
                        if ($valeur_offre > $vals[1]) {
                            $vals = $vals[0] . ',' . $vals[1] . ',' . $_SESSION['ID'] . ',' . $valeur_offre;
                        }
                        else {
                            $vals = $_SESSION['ID'] . ',' . $valeur_offre . ',' . $vals[0] . ',' . $vals[1];
                        }
                    }
                    $sql = "UPDATE item SET ValeurEnchere = '$vals' WHERE ID = '$item';";
                    $result = mysqli_query($db_handle, $sql);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Enchère - Agora Francia</title>
        <link rel="stylesheet" href="style.css" />
        <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <script type='text/javascript'>
            alert('Votre enchère à été enregistré');
            window.location.href = '../parcourir/parcourir.php';
        </script>
    </body>
    </html>
    <?php
                }
            }
            else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Enchère - Agora Francia</title>
        <link rel="stylesheet" href="style.css" />
        <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <script type='text/javascript'>
            alert('Vous devez enchérir au-dessus du prix initial de l\'enchère');
            window.location.href = '../parcourir/parcourir.php';
        </script>
    </body>
    </html>
<?php
            }
        } else {
                echo "pb lors de l'exécution de la requête SQL";
            }
    }
?>

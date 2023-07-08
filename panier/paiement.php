<?php
    session_start();
    $database = "piscine";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    if($db_found) {
        $prix = 0;
        foreach ($_SESSION['panier'] as $item) {
            $sql = "SELECT Prix, Vendeur FROM item WHERE ID = '$item';";
            $result = mysqli_query($db_handle, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $prix += $row['Prix'];
                    $ID_vendeur = $row['Vendeur'];
                }
            } else {
                echo mysqli_error($db_handle);
            }
        }
        if ($_SESSION['Solde'] > $prix && $_SESSION['TypeCarte'] != "") {
        if ($_SESSION['Solde'] > $prix) {
            $achats = "";
            foreach ($_SESSION['panier'] as $item) {
                $achats .= $item . ',';
                $sql = "UPDATE item SET Etat = 0, Vendeur = -1 WHERE ID = '$item';";
                $result = mysqli_query($db_handle, $sql);
            }
            $achats = rtrim($achats, ",");
            $_SESSION['Solde'] -= $prix;
            $sql = "UPDATE Acheteur SET Solde = '{$_SESSION['Solde']}', Achats = CONCAT(Achats, '$achats') WHERE ID = '{$_SESSION['ID']}';";
            $result = mysqli_query($db_handle, $sql);
            $sql = "UPDATE Vendeur SET Solde = Solde + '$prix' WHERE ID = '$ID_vendeur';";
            $result = mysqli_query($db_handle, $sql);
            $_SESSION['panier'] = array();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Paiement - Agora Francia</title>
    <link rel="stylesheet" href="style.css" />
    <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
</head>
<body>
    <script type='text/javascript'>
        alert('Le paiement a bien été effectué ');
        window.location.href = '../panier/panier.php';
    </script>
</body>
</html>
<?php
            exit();
        }
        else {
            ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Paiement - Agora Francia</title>
    <link rel="stylesheet" href="style.css" />
    <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
</head>
<body>
    <script type='text/javascript'>
        alert('Vous n\'avez pas une solde suffisante sur votre compte');
        window.location.href = '../panier/panier.php';
    </script>
</body>
</html>
<?php
        }
    }
}
?>
<?php
    session_start(); // Démarrer la session
    $database = "piscine";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $statut = $_SESSION['Statut'];
    $acheteur = isset($_POST["Acheteur"]) ? $_POST["Acheteur"] : "";
    $adresse1 = isset($_POST["Adresse1"]) ? $_POST["Adresse1"] : "";
    $adresse2 = isset($_POST["Adresse2"]) ? $_POST["Adresse2"] : "";
    $ville = isset($_POST["Ville"]) ? $_POST["Ville"] : "";
    $codepostal = isset($_POST["CodePostal"]) ? $_POST["CodePostal"] : "";
    $pays = isset($_POST["Pays"]) ? $_POST["Pays"] : "";
    $tel = isset($_POST["Tel"]) ? $_POST["Tel"] : "";
    $typecarte = isset($_POST["TypeCarte"]) ? $_POST["TypeCarte"] : "";
    $numcarte = isset($_POST["NumCarte"]) ? $_POST["NumCarte"] : "";
    $nomcarte = isset($_POST["NomCarte"]) ? $_POST["NomCarte"] : "";
    $dateexp = isset($_POST["DateExp"]) ? $_POST["DateExp"] : "";
    $code = isset($_POST["code"]) ? $_POST["code"] : "";
    $solde = isset($_POST["Solde"]) ? $_POST["Solde"] : "";
    $_SESSION["Acheteur"] = $acheteur;
    // Si le bouton INSCRIPTION-INFO-PAYEMENT est cliqué
    if (isset($_POST["saisirInfoBancaire"])) {
        if ($db_found) {
            $sql = "INSERT INTO Acheteur (`Adresse1`, `Adresse2`, `Ville`, `CodePostal`, `Pays`, `Tel`, `TypeCarte`, `NumCarte`, `NomCarte`, `DateExp`, `Code`, `Solde` ) VALUES ('$adresse1', '$adresse2', '$ville', '$codepostal', '$pays', '$tel', '$typecarte', '$numcarte', '$nomcarte', '$dateexp', '$code', '$solde');";
            $result = mysqli_query($db_handle, $sql);
            $sql = "SELECT * FROM Acheteur WHERE Mail = '$mail'";
            $result = mysqli_query($db_handle, $sql);
            echo "avant";
            if ($result) {
                echo "pendant1";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "pendant2";
                    $adresse1 = $row['Adresse1'];
                    $adresse2 = $row['Adresse2'];
                    $ville = $row['Ville'];
                    $codepostal = $row['CodePostal'];
                    $pays = $row['Pays'];
                    $tel = $row['Tel'];
                    $typecarte = $row['TypeCarte'];
                    $numcarte = $row['NumCarte'];
                    $nomcarte = $row['NomCarte'];
                    $dateexp = $row['DateExp'];
                    $code = $row['Code'];
                    $solde = $row['Solde'];
                }
                $_SESSION['Adresse1'] = $adresse1;
                $_SESSION['Adresse2'] = $adresse2;
                $_SESSION['Ville'] = $ville;
                $_SESSION['CodePostal'] = $codepostal;
                $_SESSION['Pays'] = $pays;
                $_SESSION['Tel'] = $tel;
                $_SESSION['TypeCarte'] = $typecarte;
                $_SESSION['NumCarte'] = $numcarte;
                $_SESSION['NomCarte'] = $nomcarte;
                $_SESSION['DateExp'] = $dateexp;
                $_SESSION['Code'] = $code;
                $_SESSION['Solde'] = $solde;
                header("Location: ../compte/compte.php");
                exit();
            } 
        echo "apres";
        }
    }
?>
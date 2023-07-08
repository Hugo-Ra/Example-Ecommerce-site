<?php
session_start(); // Démarrer la session
$database = "piscine";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$statut = $_SESSION['Statut'];
switch($statut) {
    case 'Admin':
        $admin = isset($_POST["Admin"]) ? $_POST["Admin"] : "";
        $statut = isset($_POST["Statut"]) ? $_POST["Statut"] : "";
        $pseudo = isset($_POST["Pseudo"]) ? $_POST["Pseudo"] : "";
        $mdp = isset($_POST["Mdp"]) ? $_POST["Mdp"] : "";
        $solde = 100000;
        $_SESSION["admin"] = $admin;
        if (isset($_POST["Connexion"])) {
            if ($db_found) {
                $sql = "SELECT * FROM Admin WHERE Pseudo = '$pseudo' AND Mdp = '$mdp'";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $pseudo = $row['Pseudo'];
                            $mdp = $row['Mdp'];
                            $solde = $row['Solde'];
                        }
                        $_SESSION['ID'] = $ID;
                        $_SESSION['Pseudo'] = $pseudo;
                        $_SESSION['Mdp'] = $mdp;
                        $_SESSION['Solde'] = $solde;
                        $_SESSION['panier'] = array();
                        $_SESSION['achats'] = array();
                        header("Location: ../accueil/accueil.php");
                        exit();
                    } else {
                        header("Location: ../compte/connexion.php");
                        exit();
                    }
                } else {
                    echo mysqli_error($db_handle);
                }
            } else {
                echo "<br>Base de données non trouvée";
            }
            mysqli_close($db_handle);
        }
        break;
    case 'Vendeur':
        $vendeur = isset($_POST["Vendeur"]) ? $_POST["Vendeur"] : "";
        $statut = isset($_POST["Statut"]) ? $_POST["Statut"] : "";
        $pseudo = isset($_POST["Pseudo"]) ? $_POST["Pseudo"] : "";
        $nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
        $prenom = isset($_POST["Prenom"]) ? $_POST["Prenom"] : "";
        $mail = isset($_POST["Mail"]) ? $_POST["Mail"] : "";
        $mdp = isset($_POST["Mdp"]) ? $_POST["Mdp"] : "";
        $photo = isset($_POST["Photo"]) ? $_POST["Photo"] : "";
        $fond = isset($_POST["Fond"]) ? $_POST["Fond"] : "";
        $solde = isset($_POST["Solde"]) ? $_POST["Solde"] : "";
        $_SESSION["Vendeur"] = $vendeur;
        // Si le bouton LOGIN est cliqué
        if (isset($_POST["Connexion"])) {
            if ($db_found) {
                $sql = "SELECT * FROM vendeur WHERE Mail = '$mail' AND Pseudo = '$pseudo'";
                $result = mysqli_query($db_handle, $sql);
                if ($result) { 
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $nom = $row['Nom'];
                            $prenom = $row['Prenom'];
                            $pseudo = $row['Pseudo'];
                            $mail = $row['Mail'];
                            $mdp = $row['Mdp'];
                            $photo = $row['Photo'];
                            $fond = $row['Fond'];
                            $solde = $row['Solde'];
                        }
                        $_SESSION['ID'] = $ID;
                        $_SESSION['Nom'] = $nom;
                        $_SESSION['Prenom'] = $prenom;
                        $_SESSION['Pseudo'] = $pseudo;
                        $_SESSION['Mail'] = $mail;
                        $_SESSION['Mdp'] = $mdp;
                        $_SESSION['Photo'] = $photo;
                        $_SESSION['Fond'] = $fond;
                        $_SESSION['Solde'] = $solde;
                        $_SESSION['panier'] = array();
                        $_SESSION['achats'] = array();
                        header("Location: ../accueil/accueil.php");
                        exit();
                    } else {
                        header("Location: ../compte/connexion.php");
                        exit();
                    }
                } else {
                    echo mysqli_error($db_handle);
                }
            } else {
                echo "<br>Base de données non trouvée";
            }
        }
        // Si le bouton SIGNUP est cliqué
        if (isset($_POST["Inscription"])) {
            if ($db_found) {
                // Vérifier si l'email est déjà utilisé
                $sql = "SELECT * FROM vendeur WHERE Mail = '$mail'";
                $result = mysqli_query($db_handle, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "Cet email est déjà utilisé. Veuillez en choisir un autre.";
                } else {
                    // Vérifier si le nom d'utilisateur est déjà utilisé
                    $sql = "SELECT * FROM vendeur WHERE Pseudo = '$pseudo'";
                    $result = mysqli_query($db_handle, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "Ce nom d'utilisateur est déjà utilisé. Veuillez en choisir un autre.";
                    } else {
                    $sql = "INSERT INTO vendeur (`ID`, `Nom`, `Prenom`, `Pseudo`, `Mail`, `Mdp`, `Photo`, `Fond`, `Solde`) VALUES (NULL, '$nom', '$prenom', '$pseudo', '$mail', '$mdp', '', '$fond', '$solde');";
                    $result = mysqli_query($db_handle, $sql);
                    $sql = "SELECT * FROM vendeur WHERE Mail = '$mail'";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) { 
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $nom = $row['Nom'];
                            $prenom = $row['Prenom'];
                            $pseudo = $row['Pseudo'];
                            $mail = $row['Mail'];
                            $mdp = $row['Mdp'];
                            $photo = $row['Photo'];
                            $fond = $row['Fond'];
                            $solde = $row['Solde'];
                        }
                        $_SESSION['ID'] = $ID;
                        $_SESSION['Nom'] = $nom;
                        $_SESSION['Prenom'] = $prenom;
                        $_SESSION['Pseudo'] = $pseudo;
                        $_SESSION['Mail'] = $mail;
                        $_SESSION['Mdp'] = $mdp;
                        $_SESSION['Photo'] = $photo;
                        $_SESSION['Fond'] = $fond;
                        $_SESSION['Solde'] = $solde;
                        $_SESSION['panier'] = array();
                        $_SESSION['achats'] = array();
                        header("Location: ../accueil/accueil.php");
                        exit();
                    } else {
                        header("Location: ../Compte/Connexion.php");
                        exit();
                    }
                } 
            }
        }
        }
        break;
    case 'Acheteur':
        $acheteur = isset($_POST["Acheteur"]) ? $_POST["Acheteur"] : "";
        $statut = isset($_POST["Statut"]) ? $_POST["Statut"] : "";
        $nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
        $prenom = isset($_POST["Prenom"]) ? $_POST["Prenom"] : "";
        $mail = isset($_POST["Mail"]) ? $_POST["Mail"] : "";
        $mdp = isset($_POST["Mdp"]) ? $_POST["Mdp"] : "";
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
        $code = isset($_POST["Code"]) ? $_POST["Code"] : "";
        $solde = isset($_POST["Solde"]) ? $_POST["Solde"] : "";
        $_SESSION["Acheteur"] = $acheteur;
        // Si le bouton LOGIN est cliqué
        if (isset($_POST["Connexion"])) {
            if ($db_found) {
                $sql = "SELECT * FROM acheteur WHERE Mail = '$mail' AND Mdp = '$mdp'";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $nom = $row['Nom'];
                            $prenom = $row['Prenom'];
                            $mail = $row['Mail'];
                            $mdp = $row['Mdp'];
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
                        $_SESSION['ID'] = $ID;
                        $_SESSION['Nom'] = $nom;
                        $_SESSION['Prenom'] = $prenom;
                        $_SESSION['Mail'] = $mail;
                        $_SESSION['Mdp'] = $mdp;
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
                        $_SESSION['panier'] = array();
                        $_SESSION['achats'] = array();
                        header("Location: ../accueil/accueil.php");
                        exit();
                    } else {
                        header("Location: ../Compte/Connexion.php");
                        exit();
                    }
                } else {
                    echo mysqli_error($db_handle);
                }
            } else {
                echo "<br>Base de données non trouvée";
            }
        }
        // Si le bouton SIGNUP est cliqué
        if (isset($_POST["Inscription"])) {
            if ($db_found) {
                // Vérifier si l'email est déjà utilisé
                $sql = "SELECT * FROM Acheteur WHERE Mail = '$mail'";
                $result = mysqli_query($db_handle, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "Cet email est déjà utilisé. Veuillez en choisir un autre.";
                } else {
                    // Vérifier si le nom d'utilisateur est déjà utilisé
                    $sql = "SELECT * FROM Acheteur WHERE Mail = '$mail'";
                    $result = mysqli_query($db_handle, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "Ce nom d'utilisateur est déjà utilisé. Veuillez en choisir un autre.";
                    } else {
                    $sql = "INSERT INTO Acheteur (`ID`, `Nom`, `Prenom`, `Mail`, `Mdp`, `Adresse1`, `Adresse2`, `Ville`, `CodePostal`, `Pays`, `Tel`, `TypeCarte`, `NumCarte`, `NomCarte`, `DateExp`, `Code`, `Solde`) VALUES (NULL, '$nom', '$prenom', '$mail', '$mdp', '', '', '', '', '', '', '', '', '', '', '', '');";
                    $result = mysqli_query($db_handle, $sql);
                    $sql = "SELECT * FROM Acheteur WHERE Mail = '$mail'";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) { 
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID = $row['ID'];
                            $nom = $row['Nom'];
                            $prenom = $row['Prenom'];
                            $mail = $row['Mail'];
                            $mdp = $row['Mdp'];
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
                        $_SESSION['ID'] = $ID;
                        $_SESSION['Nom'] = $nom;
                        $_SESSION['Prenom'] = $prenom;
                        $_SESSION['Mail'] = $mail;
                        $_SESSION['Mdp'] = $mdp;
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
                        $_SESSION['panier'] = array();
                        $_SESSION['achats'] = array();
                        header("Location: ../accueil/accueil.php");
                        exit();
                    } else {
                        header("Location: ../compte/connexion.php");
                        exit();
                    }
                } 
            }
        }
    }
    // Si le bouton INSCRIPTION-INFO-PAYEMENT est cliqué
    if (isset($_POST["saisirInfoBancaire"])) {
        if ($db_found) {
            $sql = "UPDATE Acheteur SET Adresse1 = '$adresse1', Adresse2 = '$adresse2', Ville = '$ville', CodePostal = '$codepostal', Pays = '$pays', Tel = '$tel', TypeCarte = '$typecarte', NumCarte = '$numcarte', NomCarte = '$nomcarte', DateExp = '$dateexp',Code = '$code', Solde = '$solde' WHERE Acheteur.`Mail` = '{$_SESSION['Mail']}';";
            $result = mysqli_query($db_handle, $sql);
            $sql = "SELECT * FROM Acheteur WHERE Mail = '$mail'";
            $result = mysqli_query($db_handle, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
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
        }
    }
    break;
}
?>
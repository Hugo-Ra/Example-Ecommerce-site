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
    <link rel="stylesheet" href="style.css" />
    <title>Liste Chat</title>
    <!--<link href="../styles.css" rel="stylesheet" type="text/css"/>-->
    <link href="../compte/listeChat.css" rel="stylesheet" type="text/css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&family=Palanquin+Dark&family=Roboto+Slab&display=swap');
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $ID = $_SESSION['ID'];
        $database = "piscine";
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);
        if ($db_found) {
    ?>
    <div id="wrapper">
        <div id="menu">
            <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="submit" name="exit" value="Retour">
            </form>
        </div><br>
        <div id="lireNotif">
            <?php
                $sql = "SELECT * FROM acheteur JOIN notif ON acheteur.ID = notif.ID_Acheteur";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ID_Acheteur = $row['ID'];
                    } 
                    }
                else {
                    echo "pb lors de l'exécution de la requête SQL";
                }
            ?>
        </div>
    </div>
    <?php
        mysqli_close($db_handle);
        }
    ?>
</body>
</html>
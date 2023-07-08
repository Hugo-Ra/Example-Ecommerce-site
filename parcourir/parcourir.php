<?php
session_start();
$_SESSION['first'] = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../img-images/favicon.ico"/>
    <title>Tout Parcourir - Agora Francia</title>
    <link href="../styles.css" rel="stylesheet" type="text/css"/>
    <link href="../parcourir/parcourir.css" rel="stylesheet" type="text/css"/>
    <!-- Importation de Font Awesome via un lien CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.header').height($(window).height());
        });
        $(document).ready(function() {
            var $imgInfo1 = $('#img-info1');
            $imgInfo1.hide();
            var $imgInfo2 = $('#img-info2');
            $imgInfo2.hide();
            var $imgInfo3 = $('#img-info3');
            $imgInfo3.hide();
            var $action1 = $('#action1');
            $action1.hide();
            var $action2 = $('#action2');
            $action2.hide();
            var $action3 = $('#action3');
            $action3.hide();
            var $carrousel1 = $('#carrousel1');
            var $img1 = $('#carrousel1 img');
            var $carrousel2 = $('#carrousel2');
            var $img2 = $('#carrousel2 img');
            var $carrousel3 = $('#carrousel3');
            var $img3 = $('#carrousel3 img'); // on cible le bloc du carrousel
            // on cible les images contenues dans le carrousel
            var indexImg1 = $img1.length - 1;
            var indexImg2 = $img2.length - 1; 
            var indexImg3 = $img3.length - 1;
            // on définit l'index du dernier élément
            var i1 = 0; // on initialise un compteur
            var i2 = 0;
            var i3 = 0;
            var $currentImg1 = $img1.eq(i1);
            var $currentImg2 = $img2.eq(i2);
            var $currentImg3 = $img3.eq(i3); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
            $img2.css('display', 'none'); // on cache les images
            $currentImg2.css('display', 'block'); // on affiche seulement l'image courante
            $img1.css('display', 'none'); // on cache les images
            $currentImg1.css('display', 'block');
            $img3.css('display', 'none'); // on cache les images
            $currentImg3.css('display', 'block');
            $('.next1').click(function() {
                i1 = (i1 + 1) % $img1.length; // Incrémente l'index et utilise l'opérateur modulo pour revenir à 0 si on atteint la dernière image
                $img1.css('display', 'none'); // Cache toutes les images
                $currentImg1 = $img1.eq(i1); // Définit la nouvelle image
                $currentImg1.css('display', 'block'); // Affiche l'image courante
            });
            $('.prev1').click(function() {
                i1 = (i1 - 1 + $img1.length) % $img1.length;
                $img1.css('display', 'none');
                $currentImg1 = $img1.eq(i1);
                $currentImg1.css('display', 'block');
            });
            $('.next2').click(function() {
                i2 = (i2 + 1) % $img2.length;
                $img2.css('display', 'none');
                $currentImg2 = $img2.eq(i2);
                $currentImg2.css('display', 'block');
            });
            $('.prev2').click(function() {
                i2 = (i2 - 1 + $img2.length) % $img2.length;
                $img2.css('display', 'none');
                $currentImg2 = $img2.eq(i2);
                $currentImg2.css('display', 'block');
            });
            $('.next3').click(function() {
                i3 = (i3 + 1) % $img3.length;
                $img3.css('display', 'none');
                $currentImg3 = $img3.eq(i3);
                $currentImg3.css('display', 'block');
            });
            $('.prev3').click(function() {
                i3 = (i3 - 1 + $img3.length) % $img3.length;
                $img3.css('display', 'none');
                $currentImg3 = $img3.eq(i3);
                $currentImg3.css('display', 'block');
            });
            $('.img-carrousel1').click(function() {
                var currentWidth = $(this).width();
                var currentHeight = $(this).height();
                if(currentWidth<121 && currentHeight<91) {
                    var newWidth = currentWidth * 4; // Double la largeur de l'image
                    var newHeight = currentHeight * 4; // Double la hauteur de l'image
                    $(this).width(newWidth);
                    $(this).height(newHeight);
                    var imageId = $(this).attr('id');
                    $.ajax({
                        url: '../parcourir/info-item.php',
                        type: 'POST',
                        data: { ID: imageId },
                        success: function(response) {
                            var info = JSON.parse(response);
                            if (info.Categorie == 'Meubles et objets d art')
                            {
                                $('#img-info1 p:nth-child(1)').text('Meubles et objets d art / Article n° ' + info.ID);
                            }
                            else if (info.Categorie == 'Articles de luxe')
                            {
                                $('#img-info1 p:nth-child(1)').text('Articles de luxe / Article n° ' + info.ID);
                            }
                            else if (info.Categorie == 'Articles réguliers')
                            {
                                $('#img-info1 p:nth-child(1)').text('Articles réguliers / Article n° ' + info.ID);
                            }
                            $('#img-info1 p:nth-child(2)').text(info.Nom);
                            $('#img-info1 p:nth-child(3)').text('Description : ');
                            $('#img-info1 p:nth-child(4)').text('' + info.Description);
                            $('#img-info1 p:nth-child(5)').text('Prix : ' + info.Prix + ' €');
                            var photos = info.Photo.split(",");
                            for (var i=1; i<photos.length; i++)
                            {
                                $('#img-bonus1').append('<img src="../img-articles/'+ photos[i] +'" max-width="250px" height="300px" class="img' + i + '">');
                            }
                            var ID_item = info.ID;
                            var ID_vendeur = info.Vendeur;
                            <?php if ($_SESSION['Statut'] == 'Acheteur' && $_SESSION['Choix'] != 'Encheres') {?>
                            var inputs = document.querySelectorAll("input[id='envoieID']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_vendeur;
                            }
                            var inputs = document.querySelectorAll("input[id='envoieID_item']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            var inputs = document.querySelectorAll("input[id='envoieID_article']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            <?php } 
                                    else if ($_SESSION['Statut'] == 'Acheteur' && $_SESSION['Choix'] == 'Encheres') {
                            ?>
                            var inputs = document.querySelectorAll("input[id='envoieID_item']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            <?php }?>
                            var $c2 = $('#carrousel2');
                            $c2.hide();
                            var $c3 = $('#carrousel3');
                            $c3.hide();
                            var $cc2 = $('#carou2');
                            $cc2.hide();
                            var $cc3 = $('#carou3');
                            $cc3.hide();
                            var $pv1 = $('#prevnext1');
                            $pv1.hide();
                            var $pv2 = $('#prevnext2');
                            $pv2.hide();
                            var $pv3 = $('#prevnext3');
                            $pv3.hide();
                            var $pv4 = $('#prevnext4');
                            $pv4.hide();
                            var $pv5 = $('#prevnext5');
                            $pv5.hide();
                            var $pv6 = $('#prevnext6');
                            $pv6.hide();
                            var $action = $('#action1');
                            $action.show();
                            var $imgInfo = $('#img-info1');
                            $imgInfo.show();
                            
                        },
                        error: function() {
                            alert('Une erreur s\'est produite lors de la requête AJAX');
                        }
                    });
                } else {
                    var newWidth = currentWidth / 4; // Double la largeur de l'image
                    var newHeight = currentHeight / 4; // Double la hauteur de l'image
                    $(this).width(newWidth);
                    $(this).height(newHeight); 
                    var $prevsuiv1 = $('#prevnext1');
                    $prevsuiv1.show(); // Affiche l'élément img-info lorsque l'image est cliquée
                    var $prevsuiv4 = $('#prevnext4');
                    $prevsuiv4.show(); // Affiche l'élément img-info lorsque l'image est cliquée
                    $('#img-bonus1').empty();
                    var $imgInfo = $('#img-info1');
                    $imgInfo.hide();
                    var $action = $('#action1');
                    $action.hide();
                    var $c2 = $('#carrousel2');
                    $c2.show();
                    var $c3 = $('#carrousel3');
                    $c3.show();
                    var $cc2 = $('#carou2');
                    $cc2.show();
                    var $cc3 = $('#carou3');
                    $cc3.show();
                    var $pv1 = $('#prevnext1');
                    $pv1.show();
                    var $pv2 = $('#prevnext2');
                    $pv2.show();
                    var $pv3 = $('#prevnext3');
                    $pv3.show();
                    var $pv4 = $('#prevnext4');
                    $pv4.show();
                    var $pv5 = $('#prevnext5');
                    $pv5.show();
                    var $pv6 = $('#prevnext6');
                    $pv6.show();
                }
            });
            $('.img-carrousel2').click(function() {
                var currentWidth = $(this).width();
                var currentHeight = $(this).height();
                if(currentWidth<121 && currentHeight<91) {
                    var newWidth = currentWidth * 4; // Double la largeur de l'image
                    var newHeight = currentHeight * 4; // Double la hauteur de l'image
                    $(this).width(newWidth);
                    $(this).height(newHeight);
                    var imageId = $(this).attr('id');
                    $.ajax({
                        url: '../parcourir/info-item.php',
                        type: 'POST',
                        data: { ID: imageId },
                        success: function(response) {
                            var info = JSON.parse(response);
                            if (info.Categorie == 'Meubles et objets d art')
                            {
                                $('#img-info2 p:nth-child(1)').text('Meubles et objets d art / Article n° ' + info.ID);
                            }
                            else if (info.Categorie == 'Articles de luxe')
                            {
                                $('#img-info2 p:nth-child(1)').text('Articles de luxe / Article n° ' + info.ID);
                            }
                            else if (info.Categorie == 'Articles réguliers')
                            {
                                $('#img-info2 p:nth-child(1)').text('Articles réguliers / Article n° ' + info.ID);
                            }
                            $('#img-info2 p:nth-child(2)').text(info.Nom);
                            $('#img-info2 p:nth-child(3)').text('Description : ');
                            $('#img-info2 p:nth-child(4)').text('' + info.Description);
                            $('#img-info2 p:nth-child(5)').text('Prix : ' + info.Prix + ' €');
                            var photos = info.Photo.split(",");
                            for (var i=1; i<photos.length; i++)
                            {
                                $('#img-bonus2').append('<img src="../img-articles/'+ photos[i] +'" max-width="250px" height="300px" class="img' + i + '">');
                            }
                            var ID_item = info.ID;
                            var ID_vendeur = info.Vendeur;
                            <?php if ($_SESSION['Statut'] == 'Acheteur' && $_SESSION['Choix'] != 'Encheres') {?>
                            var inputs = document.querySelectorAll("input[id='envoieID']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_vendeur;
                            }
                            var inputs = document.querySelectorAll("input[id='envoieID_item']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            var inputs = document.querySelectorAll("input[id='envoieID_article']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            <?php } 
                                    else if ($_SESSION['Statut'] == 'Acheteur' && $_SESSION['Choix'] == 'Encheres') {
                            ?>
                            var inputs = document.querySelectorAll("input[id='envoieID_item']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            <?php }?>
                            var $c1 = $('#carrousel1');
                            $c1.hide();
                            var $c3 = $('#carrousel3');
                            $c3.hide();
                            var $cc1 = $('#carou1');
                            $cc1.hide();
                            var $cc3 = $('#carou3');
                            $cc3.hide();
                            var $pv1 = $('#prevnext1');
                            $pv1.hide();
                            var $pv2 = $('#prevnext2');
                            $pv2.hide();
                            var $pv3 = $('#prevnext3');
                            $pv3.hide();
                            var $pv4 = $('#prevnext4');
                            $pv4.hide();
                            var $pv5 = $('#prevnext5');
                            $pv5.hide();
                            var $pv6 = $('#prevnext6');
                            $pv6.hide();
                            var $action = $('#action2');
                            $action.show();
                            var $imgInfo = $('#img-info2');
                            $imgInfo.show();
                        },
                        error: function() {
                            alert('Une erreur s\'est produite lors de la requête AJAX');
                        }
                    });
                } else {
                    var newWidth = currentWidth / 4; // Double la largeur de l'image
                    var newHeight = currentHeight / 4; // Double la hauteur de l'image
                    $(this).width(newWidth);
                    $(this).height(newHeight); 
                    var $prevsuiv2 = $('#prevnext2');
                    $prevsuiv2.show(); // Affiche l'élément img-info lorsque l'image est cliquée
                    var $prevsuiv4 = $('#prevnext4');
                    $prevsuiv4.show(); // Affiche l'élément img-info lorsque l'image est cliquée
                    $('#img-bonus2').empty();
                    var $imgInfo = $('#img-info2');
                    $imgInfo.hide();
                    var $action = $('#action2');
                    $action.hide();
                    var $c1 = $('#carrousel1');
                    $c1.show();
                    var $c3 = $('#carrousel3');
                    $c3.show();
                    var $cc1 = $('#carou1');
                    $cc1.show();
                    var $cc3 = $('#carou3');
                    $cc3.show();
                    var $pv1 = $('#prevnext1');
                    $pv1.show();
                    var $pv2 = $('#prevnext2');
                    $pv2.show();
                    var $pv3 = $('#prevnext3');
                    $pv3.show();
                    var $pv4 = $('#prevnext4');
                    $pv4.show();
                    var $pv5 = $('#prevnext5');
                    $pv5.show();
                    var $pv6 = $('#prevnext6');
                    $pv6.show();
                }
            });
            $('.img-carrousel3').click(function() {
                var currentWidth = $(this).width();
                var currentHeight = $(this).height();
                if(currentWidth<121 && currentHeight<91) {
                    var newWidth = currentWidth * 4; // Double la largeur de l'image
                    var newHeight = currentHeight * 4; // Double la hauteur de l'image
                    $(this).width(newWidth);
                    $(this).height(newHeight);
                    var imageId = $(this).attr('id');
                    $.ajax({
                        url: '../parcourir/info-item.php',
                        type: 'POST',
                        data: { ID: imageId },
                        success: function(response) {
                            var info = JSON.parse(response);
                            if (info.Categorie == 'Meubles et objets d art')
                            {
                                $('#img-info3 p:nth-child(1)').text('Meubles et objets d art / Article n° ' + info.ID);
                            }
                            else if (info.Categorie == 'Articles de luxe')
                            {
                                $('#img-info3 p:nth-child(1)').text('Articles de luxe / Article n° ' + info.ID);
                            }
                            else if (info.Categorie == 'Articles réguliers')
                            {
                                $('#img-info3 p:nth-child(1)').text('Articles réguliers / Article n° ' + info.ID);
                            }
                            $('#img-info3 p:nth-child(2)').text(info.Nom);
                            $('#img-info3 p:nth-child(3)').text('Description : ');
                            $('#img-info3 p:nth-child(4)').text('' + info.Description);
                            $('#img-info3 p:nth-child(5)').text('Prix : ' + info.Prix + ' €');
                            var photos = info.Photo.split(",");
                            for (var i=1; i<photos.length; i++)
                            {
                                $('#img-bonus3').append('<img src="../img-articles/'+ photos[i] +'" max-width="250px" height="300px" class="img' + i + '">');
                            }
                            var ID_item = info.ID;
                            var ID_vendeur = info.Vendeur;
                            <?php if ($_SESSION['Statut'] == 'Acheteur' && $_SESSION['Choix'] != 'Encheres') {?>
                            var inputs = document.querySelectorAll("input[id='envoieID']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_vendeur;
                            }
                            var inputs = document.querySelectorAll("input[id='envoieID_item']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            var inputs = document.querySelectorAll("input[id='envoieID_article']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            <?php } 
                                    else if ($_SESSION['Statut'] == 'Acheteur' && $_SESSION['Choix'] == 'Encheres') {
                            ?>
                            var inputs = document.querySelectorAll("input[id='envoieID_item']");
                            for (var i = 0; i < inputs.length; i++) {
                                var input = inputs[i];
                                input.value = ID_item;
                            }
                            <?php }?>
                            var $c1 = $('#carrousel1');
                            $c1.hide();
                            var $c2 = $('#carrousel2');
                            $c2.hide();
                            var $cc1 = $('#carou1');
                            $cc1.hide();
                            var $cc2 = $('#carou2');
                            $cc2.hide();
                            var $pv1 = $('#prevnext1');
                            $pv1.hide();
                            var $pv2 = $('#prevnext2');
                            $pv2.hide();
                            var $pv3 = $('#prevnext3');
                            $pv3.hide();
                            var $pv4 = $('#prevnext4');
                            $pv4.hide();
                            var $pv5 = $('#prevnext5');
                            $pv5.hide();
                            var $pv6 = $('#prevnext6');
                            $pv6.hide();
                            var $action = $('#action3');
                            $action.show();
                            var $imgInfo = $('#img-info3');
                            $imgInfo.show();
                            
                        },
                        error: function() {
                            alert('Une erreur s\'est produite lors de la requête AJAX');
                        }
                    });
                } else {
                    var newWidth = currentWidth / 4; // Double la largeur de l'image
                    var newHeight = currentHeight / 4; // Double la hauteur de l'image
                    $(this).width(newWidth);
                    $(this).height(newHeight); 
                    var $prevsuiv = $('#prevnext3');
                    $prevsuiv.show(); // Affiche l'élément img-info lorsque l'image est cliquée
                    $('#img-bonus3').empty();
                    var $imgInfo = $('#img-info3');
                    $imgInfo.hide();
                    var $action = $('#action3');
                    $action.hide();
                    var $c1 = $('#carrousel1');
                    $c1.show();
                    var $c2 = $('#carrousel2');
                    $c2.show();
                    var $cc1 = $('#carou1');
                    $cc1.show();
                    var $cc2 = $('#carou2');
                    $cc2.show();
                    var $pv1 = $('#prevnext1');
                    $pv1.show();
                    var $pv2 = $('#prevnext2');
                    $pv2.show();
                    var $pv3 = $('#prevnext3');
                    $pv3.show();
                    var $pv4 = $('#prevnext4');
                    $pv4.show();
                    var $pv5 = $('#prevnext5');
                    $pv5.show();
                    var $pv6 = $('#prevnext6');
                    $pv6.show();
                }
            });
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
                $sql = "SELECT ID, Photo, Categorie, Etat, TypeVente FROM item";
                $result = mysqli_query($db_handle, $sql);
                if ($result) {
                    $df_item = array();
                    $tab_categorie = array();
                    $tab_typeVente = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $etat = $row['Etat'];
                        if ($etat != 0) {
                            $photo = $row['Photo'];
                            $ID = $row['ID'];
                            $tab_categorie[] = $row['Categorie'];
                            $tab_typeVente[] = $row['TypeVente'];
                            $photos = explode(",", $photo);
                            $row_df = array($ID => $photos);
                            $df_item[] = $row_df;
                        }
                    }
                } else {
                    echo "pb lors de l'exécution de la requête SQL";
                }
                if ($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
            ?>
            <!-- BOUTONS Enchères et Ventes -->
            <div class="ench_vente">
                <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="submit" name="Encheres" value="Enchères">
                    <input type="submit" name="Ventes" value="Ventes">
                </form>
            </div>
            <!-------------------------------->
            <?php
                }
                else {
                    if (!isset($_SESSION['reloadPar'])) {
                    $_SESSION['reloadPar'] = "des patates masi d'autres";
            ?>
                    <script type="text/javascript">
                        location.reload(true);
                    </script>
            <?php
                    }
                    if (isset($_POST['Encheres'])) {
                        $_SESSION['Choix'] = 'Encheres';
                    }
                    if (isset($_POST['Ventes'])) {
                        $_SESSION['Choix'] = 'Ventes';
                    }
            ?>
            <!-- BOUTONS Enchères et Ventes -->
            <div class="ench_vente">
                <form id="exit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="submit" name="Encheres" value="Enchères">
                    <input type="submit" name="Ventes" value="Ventes">
                </form>
            </div>
            <!-------------------------------->
            <?php
                if ($_SESSION['Choix'] == 'Encheres') {
                    echo '<h1 style="padding: 25px;">Enchères</h1>';
                }
                else {
                    echo '<h1>Ventes</h1>';
                }
            ?>
            <!-------------------------------------------Carousel Meubles et objets d'art------------------------------------------->
            <h2 id="carou1">Meubles et objets d'art</h2>
            <div id="encadre0">
                <div id="encadre1">
                    <div id="encadre2">
                        <div id="prevnext1">
                            <button value="<" class="prev1">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                                </svg>
                            </button>
                        </div>
                        <div id="carrousel1">
                            <?php
                                $a=0;
                                for ($i = 0; $i < count($df_item); $i++) 
                                {
                                    if ($tab_categorie[$i] == 'Meubles et objets d art' && $tab_typeVente[$i] == $_SESSION['Choix']) {
                                        $a = $a + 1;
                                        echo '<img src="../img-articles/' . $df_item[$i][key($df_item[$i])][0] . '" width="120" height="90" id="' . key($df_item[$i]) .'" class="img-carrousel1">';
                                    }
                                }
                                if ($a == 0)
                                {
                                    echo '<p id="vide">Aucun article</p>';
                                }
                            ?>
                        </div>
                        <div id="prevnext4">
                            <button type="button" value=">" class="next1">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="encadre3">
                        <div id="encadre4">
                            <div id="img-info1">
                                <p><!--Catégorie et ID--></p>
                                <p><!--Nom--></p>
                                <p><!--Description--></p>
                                <p><!--Description--></p>
                                <p><!--Prix--></p> 
                            </div>
                        </div>
                        <div id="encadre5">
                            <div id="action1">
                                <?php
                                    if ($_SESSION['Choix'] == 'Encheres' && $_SESSION['Statut'] == 'Acheteur') {
                                ?>
                                <form id="encherir_form" method="POST" action="../parcourir/encherir.php">
                                    <input id="envoieID_item" type="hiden" name="envoieID_item">
                                    <input id="montant" type="number" step="0.1" name="montant" placeholder="0.00 €">
                                    <input type="submit" name="encherir" value="Enchérir">
                                </form>
                                <?php
                                    } else {
                                ?>
                                    <?php if ($_SESSION['Statut'] == 'Acheteur') {?>
                                        <form id="ajoutPanier" method="POST" action="../panier/ajoutPanier.php">
                                            <input id="envoieID_item" type="hiden" name="envoieID_item">
                                            <input type="submit" name="ajout" value="Ajouter au panier">
                                        </form>
                                        <form id="nego" method="post" action="../parcourir/chatroom.php">
                                            <input id="envoieID" type="hiden" name="envoieID">
                                            <input id="envoieID_article" type="hiden" name="envoieID_article">
                                            <input type="submit" value="Négocier">
                                        </form>
                                    <?php } ?>
                            <?php   } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div id="img-bonus1"></div>
            </div>
            <!-------------------------------------------Carousel Articles de luxe------------------------------------------->
            <h2 id="carou2">Articles de luxe</h2>
            <div id="encadre0">
                <div id="encadre1">
                    <div id="encadre2">
                        <div id="prevnext2">
                            <button value="<" class="prev2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                                </svg>
                            </button>
                        </div>
                        <div id="carrousel2">
                            <?php
                                $a=0;
                                for ($i = 0; $i < count($df_item); $i++) {
                                    if ($tab_categorie[$i] == 'Articles de luxe' && $tab_typeVente[$i] == $_SESSION['Choix']) {
                                        $a = $a + 1;
                                        echo '<img src="../img-articles/' . $df_item[$i][key($df_item[$i])][0] . '" width="120" height="90" id="' . key($df_item[$i]) .'" class="img-carrousel2">';
                                    }  
                                }
                                if ($a == 0)
                                {
                                    echo '<p id="vide">Aucun article</p>';
                                }
                            ?>
                        </div>
                        <div id="prevnext5">
                            <button type="button" value=">" class="next2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="encadre3">
                        <div id="encadre4">
                            <div id="img-info2">
                                <p><!--Catégorie et ID--></p>
                                <p><!--Nom--></p>
                                <p><!--Description--></p>
                                <p><!--Description--></p>
                                <p><!--Prix--></p> 
                            </div>
                        </div>
                        <div id="encadre5">
                            <div id="action2">
                                <?php
                                    if ($_SESSION['Choix'] == 'Encheres' && $_SESSION['Statut'] == 'Acheteur') {
                                ?>
                                <form id="encherir_form" method="POST" action="../parcourir/encherir.php">
                                    <input id="envoieID_item" type="hiden" name="envoieID_item">
                                    <input id="montant" type="number" step="0.1" name="montant" placeholder="0.00 €">
                                    <input type="submit" name="encherir" value="Enchérir">
                                </form>
                                <?php
                                    } else {
                                ?>
                                    <?php if ($_SESSION['Statut'] == 'Acheteur') {?>
                                        <form id="ajoutPanier" method="POST" action="../panier/ajoutPanier.php">
                                            <input id="envoieID_item" type="hiden" name="envoieID_item">
                                            <input type="submit" name="ajout" value="Ajouter au panier">
                                        </form>
                                        <form id="nego" method="post" action="../parcourir/chatroom.php">
                                            <input id="envoieID" type="hiden" name="envoieID">
                                            <input id="envoieID_article" type="hiden" name="envoieID_article">
                                            <input type="submit" value="Négocier">
                                        </form>
                                    <?php } ?>
                            <?php   } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div id="img-bonus2"></div>
            </div>
            <!-------------------------------------------Carousel Articles réguliers------------------------------------------->
            <h3 id="carou3">Articles réguliers</h3>
            <div id="encadre0">
                <div id="encadre1">
                    <div id="encadre2">
                        <div id="prevnext3">
                            <button value="<" class="prev3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                                </svg>
                            </button>
                        </div>
                        <div id="carrousel3">
                            <?php
                                $a=0;
                                for ($i = 0; $i < count($df_item); $i++) {
                                    if ($tab_categorie[$i] == 'Articles réguliers' && $tab_typeVente[$i] == $_SESSION['Choix']){
                                        $a = $a + 1;
                                        echo '<img src="../img-articles/' . $df_item[$i][key($df_item[$i])][0] . '" width="120" height="90" id="' . key($df_item[$i]) .'" class="img-carrousel3">';
                                    }
                                }
                                if ($a == 0)
                                {
                                    echo '<p id="vide">Aucun article</p>';
                                }
                            ?>
                        </div>
                        <div id="prevnext6">
                            <button type="button" value=">" class="next3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="encadre3">
                        <div id="encadre4">
                            <div id="img-info3">
                                <p><!--Catégorie et ID--></p>
                                <p><!--Nom--></p>
                                <p><!--Description--></p>
                                <p><!--Description--></p>
                                <p><!--Prix--></p> 
                            </div>
                        </div>
                        <div id="encadre5">
                            <div id="action3">
                                <?php
                                    if ($_SESSION['Choix'] == 'Encheres' && $_SESSION['Statut'] == 'Acheteur') {
                                ?>
                                <form id="encherir_form" method="POST" action="../parcourir/encherir.php">
                                    <input id="envoieID_item" type="hiden" name="envoieID_item">
                                    <input id="montant" type="number" step="0.1" name="montant" placeholder="0.00 €">
                                    <input type="submit" name="encherir" value="Enchérir">
                                </form>
                                <?php
                                    } else {
                                ?>
                                    <?php if ($_SESSION['Statut'] == 'Acheteur') {?>
                                        <form id="ajoutPanier" method="POST" action="../panier/ajoutPanier.php">
                                            <input id="envoieID_item" type="hiden" name="envoieID_item">
                                            <input type="submit" name="ajout" value="Ajouter au panier">
                                        </form>
                                        <form id="nego" method="post" action="../parcourir/chatroom.php">
                                            <input id="envoieID" type="hiden" name="envoieID">
                                            <input id="envoieID_article" type="hiden" name="envoieID_article">
                                            <input type="submit" value="Négocier">
                                        </form>
                                    <?php } ?>
                            <?php   } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div id="img-bonus3"></div>
            </div>
            <!--<div id="bigImg"></div>-->
            <?php } ?>
        </div>
        <?php include '../footer/footer.html'; ?>
    </div>
    <?php
        } else {
            echo 'pb de connexion a la bdd';
        }
    ?>
</body>
</html>
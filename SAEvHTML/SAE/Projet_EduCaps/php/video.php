<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>EduCaps</title>
        <link rel="stylesheet" href="./../css/style.css" type="text/css"/>
    </head>
    <body>
        <?php
        session_start();
        include_once './../connexion.php';
        $idVideo = $_REQUEST['id'];
        $leTheme = $_REQUEST['theme'];
        $ordreSQL = "SELECT titreVid, descVid, cheminVid, cheminMinia, auteurVid, datePubli, pseudoU FROM Video JOIN Users ON Video.auteurVid = Users.idUser WHERE idVid = '$idVideo'";
        $resultat = $laConnexion->query($ordreSQL);
        $laVideo = $resultat->fetch();
        ?>
        <div class="screen">
            <h1><?php echo $leTheme ?></h1>
            <video controls poster="<?php $laVideo['cheminMinia']; ?>">
                <source src="<?php echo $laVideo['cheminVid']; ?>" type="video/mp4" />
                Votre navigateur ne supporte pas la vidéo
            </video>
            <?php 
            if ($_SESSION['type'] == "admin"){
                ?>
            <form action="./supprimer.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $idVideo; ?>"/>
                <input type="hidden" name="cheminV" value="<?php echo $laVideo['cheminVid']; ?>"/>
                <input type="hidden" name="cheminM" value="<?php echo $laVideo['cheminMinia']; ?>"/>
                <button type="submit" value="Supprimer" name="cmdRedirect" class="supprimer"></button>
            </form> 
            <?php 
            }
            ?>
            <a href="<?php echo $laVideo['cheminVid']; ?>" download="<?php echo $laVideo['titreVid'];?>">
                <img src="./../Design/Download.webp" alt="download" class="download" />
            </a>
            <p class="description classic">
                Titre de la capsule : <?php echo $laVideo['titreVid']; ?>
                <br/><br/>
                Description : <?php echo $laVideo['descVid']; ?>
                <br/><br/>
                Auteur : <?php echo $laVideo['pseudoU']; ?>&nbsp;&nbsp;&nbsp;&nbsp;Date de publication : <?php echo $laVideo['datePubli']; ?>
            </p>
            <div class="navbar"></div>
        <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
        <div class="triangle"></div>
        <a class="rectangleL" href="./repertoire.php"></a>
        <a id="buttonPdp" href="./Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
        </div>
    </body>
</html>

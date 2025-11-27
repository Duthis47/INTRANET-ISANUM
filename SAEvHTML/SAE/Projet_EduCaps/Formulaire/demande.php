<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>EduCaps</title>
        <link href="./../css/style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <?php
        session_start();
        include_once './../connexion.php';
        ?>
        <div class='screen'>
            <h1>Demande de promotion</h1>
            <div class='uneDemande'>
                <?php
                $idForm = $_REQUEST['form'];
                $demandeur = $_REQUEST['demandeur'];
                $ordreSQL = "SELECT descForm, Formulaire.idUser, cheminDoc, nomDoc, nomTheme, Formulaire.idTheme, Users.mailU FROM Formulaire JOIN Documents ON Formulaire.idForm = Documents.idForm JOIN Themes ON Formulaire.idTheme = Themes.idTheme JOIN Users ON Formulaire.idUser = Users.idUser WHERE Formulaire.idForm = $idForm";
                $resultat = $laConnexion->query($ordreSQL);
                $docs = $resultat->fetchall();
                ?>
                <h2> Postulant : <?php echo $demandeur; ?></h2>
                <h3>Le domaine souhaité : <?php echo $docs[0]['nomTheme']; ?></h3>
                <p>Ses motivations : <?php echo $docs[0]['descForm']; ?></p>
                <div> 
                    <?php 
                    foreach($docs as $doc){ ?>
                        <a href='<?php echo $doc['cheminDoc']; ?>' download='<?php echo $doc['nomDoc']; ?>'><?php echo $doc['nomDoc']; ?></a>
                        <br/>
                    <?php 
                    }
                    ?>
                </div>
                <div class='accepter'>
                    <form action="./accept_refus.php" method='POST'>
                        <button type='submit' name='btnChoix' value='Refuser' class='buttonLink' style='background-color:#F44336'>Refuser</button>
                        <button type='submit' name='btnChoix' value='Accepter' class='buttonLink'>Accepter</button>
                        <input type='hidden' name='id' value='<?php echo $docs[0]['idUser']; ?>'/>
                        <input type='hidden' name='mailU' value='<?php echo $docs[0]['mailU']; ?>' />
                        <input type='hidden' name='idTheme' value='<?php echo$docs[0]['idTheme'] ?>'/>
                    </form>
                </div>
            </div>
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./../php/repertoire.php"></a>
            <a id="buttonPdp" href="./../php/Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
        </div>
    </body>
</html>

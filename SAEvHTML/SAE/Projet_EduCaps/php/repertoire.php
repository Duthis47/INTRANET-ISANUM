<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="./../css/style.css" rel="stylesheet" type="text/css"/>
        <title>EduCaps</title>
    </head>
    <body>
        <div class="screen">
            <h1>Themes</h1>
            <div>
            <?php
                include_once './../connexion.php';
                $page=isset($_REQUEST['page']) ? (int)$_REQUEST['page'] : 1;
                $ordreSQL="SELECT nomTheme, idTheme FROM Themes";
                $resultat=$laConnexion->query($ordreSQL);
                $lesTuples=$resultat->fetchall();
                $taille=count($lesTuples);
                $items=array_slice($lesTuples, ($page-1)*6, 6);
                foreach($items as $item){
                    ?> 
                    <a href="./listeVideo.php?id=<?php echo $item["idTheme"]; ?>&theme=<?php echo $item["nomTheme"]?>" class="rep" >
                        <div style="color:#32CD32;"><?php echo $item["nomTheme"] ;?></div>
                    </a>
                    <?php
                    }
                    ?>
            </div>
            <?php 
            if ($page > 1) {
                ?>
            <a href="./repertoire.php?page=<?php echo $page-1; ?>" class="backward"></a>
            <?php 
            }
            if ($page <= (int)($taille/6)) {
            ?>
            <a href="./repertoire.php?page=<?php echo $page+1; ?>" class="forward"></a>
            <?php
            } 
            ?>
            <!-- Ci dessous le code générique pour la barre du -->
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./repertoire.php"></a>
            <a id="buttonPdp" href="./Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
    </div>
    </body>
</html>

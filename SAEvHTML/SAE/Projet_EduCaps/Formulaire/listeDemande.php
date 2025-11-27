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
        <div class="screen">
            <h1>Demandes de promotion</h1>
            <form action='./listeDemande.php' method='GET' class='formLstDem'>
                <label>Filtrer par Theme : <select name="lstTheme">
                        <option value='null'>Tous</option>
                        <?php
                        $ordreRecup = "SELECT idTheme, nomTheme FROM Themes";
                        $resultat = $laConnexion->query($ordreRecup);
                        $themes = $resultat->fetchall();
                        foreach($themes as $theme){
                        ?>
                        <option value="<?php echo $theme['idTheme']; ?>"><?php echo $theme['nomTheme']; ?></option>
                        <?php
                        }
                        ?>
                    </select></label>
                <br/>
                <input type="submit" name="cmdEnvoyer" value="Envoyer" style='width:25%'>
            </form>
            <div class='containDems'>
            <?php
            $idTheme = isset($_REQUEST['lstTheme']) ? $_REQUEST['lstTheme'] : null;
            if ($idTheme != null && $idTheme != "null"){
            $ordreSQL = "SELECT Formulaire.idForm, descForm, pseudoU, nomTheme, Formulaire.idTheme FROM Formulaire JOIN Users ON Formulaire.idUser = Users.idUser JOIN Themes ON Formulaire.idTheme = Themes.idTheme WHERE Formulaire.idTheme = $idTheme GROUP BY Formulaire.idForm";
            }
            else {
            $ordreSQL = "SELECT Formulaire.idForm, descForm, pseudoU, nomTheme, Formulaire.idTheme FROM Formulaire JOIN Users ON Formulaire.idUser = Users.idUser JOIN Themes ON Formulaire.idTheme = Themes.idTheme GROUP BY Formulaire.idForm";
            }
            $resultat = $laConnexion->query($ordreSQL);
            $forms = $resultat->fetchall();
            $page = isset($_REQUEST['pages']) ? $_REQUEST['pages'] : 1;
            $taille = count($forms);
            if ($forms != null && !empty($forms)){
            
            $tab = array_slice($forms, ($page - 1)*3, 3);
            foreach($tab as $uneDemande){
            ?>
            <div class='demande'>
                <div class='contLeft'>
                    <h3><?php echo $uneDemande['pseudoU'] ?></h3>
                    <p>Professeur de <?php echo $uneDemande['nomTheme'] ?></p>
                </div>
                <div class='contRight'>
                    <div class='contRightHaut'>
                        <p><?php echo $uneDemande['descForm']; ?></p>
                    </div>
                    <div class='contRightBas'>
                        <a href='./demande.php?demandeur=<?php echo $uneDemande['pseudoU'];?>&form=<?php echo $uneDemande['idForm']; ?>' class='buttonLink'>Consulter</a>
                    </div>
                </div>
            </div>
            <?php
            }
            }
            else {
            echo "Pas de demande de passage en tant que prof";
            }
            ?>
            </div>
            <?php
    if ($page > 1) {
    ?>
        <a href="./listeDemande.php?pages=<?php echo $page-1; ?>&lstTheme=<?php echo $idTheme; ?>" class="backward" style='top:82%'></a>
    <?php
    }
    if ($page <= (int)($taille/3) && ($taille%3) != 0) {
    ?>
        <a href="./listeDemande.php?pages=<?php echo $page+1; ?>&lstTheme=<?php echo $idTheme; ?>" class="forward" style='top:82%'></a>
    <?php
    }
    ?>
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./../php/repertoire.php"></a>
            <a id="buttonPdp" href="./../php/Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
        </div>
    </body>
</html>

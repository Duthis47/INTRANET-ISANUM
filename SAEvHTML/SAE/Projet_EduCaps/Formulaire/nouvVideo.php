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
        $id = $_SESSION['id']
        ?>
        <div class="screen">
            <h1> Ajoutez une vidéo </h1>
            <form action="./ajoutVideo.php" method="POST" enctype="multipart/form-data" class="formFormulaire">
                <label>Titre de la vidéo : <input type="text" name="txtTitre" placeholder="Titre de la video" maxlength="30" required/></label>
                <br/>
                <br/>
                <label>Description : <textarea name="txtDesc" rows="4" maxlength="500" placeholder="Description de la video" class ="textAreaForm" required></textarea></label>
                <br/>
                <br/>
                <label>Video : <input type="file" name="video" class="buttonLink" accept="video/mp4" required/></label>
                <br/>
                <br/>
                <label>Miniature : <input type="file" name="minia" class="buttonLink" accept="image/*" required/></label>
                <br/>
                <br/>
                <label>Choisissez le/les theme(s) de la video :<select name="lstTheme[]" multiple required>
                    <?php
                    $ordreRecup = "SELECT Qualifier.idTheme, nomTheme FROM Qualifier JOIN Themes ON Qualifier.idTheme = Themes.idTheme WHERE Qualifier.idUser = $id";
                    $resultat=$laConnexion->query($ordreRecup);
                    $themes=$resultat->fetchall();
                    foreach($themes as $theme){
                    ?>
                    <option value="<?php echo $theme['idTheme']; ?>"><?php echo $theme['nomTheme'] ?></option>
                    <?php
                    }
                    ?>
                    </select></label>
                <br/>
                <br/>
                <button type = 'submit' name = 'cmdEnvoyer' value = 'Valider' class = 'buttonLink'>Valider</button>
            </form>
            <?php 
            if(isset($_REQUEST['ajout'])){
                if ($_REQUEST['ajout']){
                    echo "Vidéo ajouté avec succès";
                }
                else {
                    echo "Echec de l'ajout de la vidéo";
                }
            }
            ?>
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./../php/repertoire.php"></a>
            <a id="buttonPdp" href="./../php/Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp" alt="pdp"/></a>
        </div>
    </body>
</html>

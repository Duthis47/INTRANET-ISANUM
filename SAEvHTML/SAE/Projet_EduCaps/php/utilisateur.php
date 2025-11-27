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
        <div class="screen">
            <?php 
                session_start();
            ?>
            <h1>Bienvenue <?php echo $_SESSION['pseudo']; ?></h1>
            <form action="./redirection.php" method="POST" class='formUser'>
                <?php 
            if ($_SESSION["type"] === "etudiant"){
                ?>
            <p class='classic' style='width:100%;'> En tant qu'étudiant, vous pouvez regarder les vidéos misent en ligne par les professeurs. 
                <br/>
                Si vous souhaitez devenir professeur, veuillez cliquer sur le bouton correspondant. Vous pouvez également changez votre mot de passe ou 
                vous déconnectez.
            <br/>
            <br/>
            <button type="submit" name="cmdRedirect" value="Prof" class='buttonLink'>Devenir professeur</button>
            <?php 
            }
            else if ($_SESSION["type"] === "admin"){
                ?>
            <p class='classic' style='width:100%'> En tant qu'administrateur, vous profitez des mêmes fonctionnalités que les étudaints, mais vous pouvez également 
                accepter les demandes des étudiants à devenir professeur. Pour cela, cliquez sur le bouton "Accepter un professeur".
                <button type='submit' name='cmdRedirect' value='Accepter' class='buttonLink'>Accepter un professeur</button>
            <?php }
            else if ($_SESSION["type"] === "prof"){ 
                ?>
            <p class='classic' style='width:100%'> En tant que professeur, vous jouissez des mêmes possibilités que lorsque vous étiez considéré comme étudiant.<br/>
                Cependant, vous pouvez désormais partagé des vidéos instructive dans le ou les domaines pour lesquelles vous êtes considérés comme professeur.
                Pour cela cliquez sur le bouton "Ajouter une vidéo". 
                Vous pouvez également soumettre une nouvelle demande pour devenir professeur dans un autre domaine.
                <button type="submit" name="cmdRedirect" value="Prof" class='buttonLink'>Devenir professeur</button>
                <button type="submit" name="cmdRedirect" value="Video" class='buttonLink'>Ajouter une Video</button>
            <?php }
            ?>
            <button type='submit' name='cmdRedirect' value='Info' class='buttonLink'>Changer de Mot de Passe</button>
            <button type="submit" name="cmdRedirect" value="Deconnexion" class='buttonLink'> Deconnexion </button>
            </p>
            </form>
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./repertoire.php"></a>
            <a id="buttonPdp" href="./Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
        </div>
    </body>
</html>

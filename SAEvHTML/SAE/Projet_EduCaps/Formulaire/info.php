<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Educaps</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href='./../css/style.css' rel='stylesheet' type='text/css'/>
    </head>
    <body>
        <?php
        session_start();
        include_once './../connexion.php';
        if (isset($_REQUEST['cmdEnvoyer'])){
            $idU = $_SESSION['id'];
            $mdpUA = $_REQUEST['pwdActuel'];
            $mdpUN = $_REQUEST['pwdNew'];
            if ($mdpUN == $_REQUEST['pwdConf']){
                $ordreVerif="SELECT idUser FROM Users WHERE idUser = $idU AND mdpU = '$mdpUA'";
                $resultat=$laConnexion->query($ordreVerif);
                $user=$resultat->fetch();
                if ($user != null){
                    $ordreModif="UPDATE Users SET mdpU = '$mdpUN' WHERE idUser = $idU";
                    $nb = $laConnexion->exec($ordreModif);
                    if ($nb==1){
                        $erreur =  "Changement du mot de passe réussi";
                    }
                    else {
                        $erreur = "Le changement de mdp a echoué, réessayez plus tard";
                    }
                }
                else {
                    $erreur = "Tapez le bon mot de passe actuel";
                }
            }
            else {
                $erreur = "Tapez le meme mot de passe dans 'nouveau' et 'confirmer'";
            }   
        }
        ?>
        <div class='screen'>
            <h1>Modifier ses infos</h1>
            <form action='info.php' method='post' class='formFormulaire'>
                <label>Tapez votre mot de passe actuel : <input type='password' placeholder='Mot de passe actuel' name='pwdActuel' required/></label>
                <br/><br/>
                <label>Tapez votre nouveau mot de passe : <input type='password' placeholder='Nouveau mot de passe' name='pwdNew' required/></label>
                <br/><br/>
                <label>Confirmer votre mot de passe : <input type='password' placeholder='Confirmer votre mot de passe' name='pwdConf' required/></label>
                <br/><br/>
                <label><button type='submit' value='Envoyer' name='cmdEnvoyer' class='buttonLink'>Valider</button></label>
                <?php if (isset($erreur)){ ?> <p style='color:red'> <?php echo $erreur; ?> </p> <?php }?>
            </form> 
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./../php/repertoire.php"></a>
            <a id="buttonPdp" href="./../php/Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
        </div>
    </body>
</html>

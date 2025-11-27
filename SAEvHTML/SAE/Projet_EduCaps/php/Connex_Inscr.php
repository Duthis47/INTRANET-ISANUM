<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>EduCaps</title>
        <link href="./../css/style.css" type="text/css" rel="stylesheet"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['pseudo'])) {
            header("Location: ./utilisateur.php");
        }
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : "Connexion";

        $s = isset($_REQUEST['cmdEnvoyer']) ? $_REQUEST['cmdEnvoyer'] : "non";
        if ($s === "Se Connecter" || $s === "S'Inscrire") {
            include './session.php';
        }
        ?>
        <div class="screen">
            <h1> <?php echo $type; ?> </h1>
            <div class="connexion">
                <form action="./Connex_Inscr.php" method = "POST">
                    <div class="high-left">
                        <label>Pseudo <br/><input type="text" name="txtPseudo" placeholder="Pseudo"/></label>
                    </div>
                    <div class="high-right">
                        <label>Mot de Passe <br/><input type="password" name="pwdMdP" placeholder="Mot de Passe"/></label></div>
                    <br/>
                    <br/>
                    <input type="hidden" name="type" value="<?php echo $type; ?>"/>

                    <?php
                    if ($type === "Connexion") {
                        ?>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class='submitConnex'>
                            <input type="submit" name ="cmdEnvoyer" value="Se Connecter"/>
                        </div>
                        <br/>
                        <br/>
                        <p>Si vous n'avez pas encore de compte, &nbsp;<a href="./Connex_Inscr.php?type=Inscription">Inscrivez-Vous</a>
                    <?php
                    } else if ($type === "Inscription") {
                        ?>
                        <div class="high-center">
                            <label>Adresse mail <br/> &nbsp;&nbsp;<input type="text" name="txtMail" placeholder="Adresse mail" /></label>
                        </div>
                        <br/>
                        <br class="br-pc"/>
                        <br class="br-pc"/>
                        <br class="br-pc"/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class='submitConnex'>
                            <input type="submit" name ="cmdEnvoyer" value="S'Inscrire"/>
                        </div>
                        <br/>
                        <br/>
                        <p>Si vous avez déja un compte, &nbsp;<a href="./Connex_Inscr.php?type=Connexion"> Connectez-Vous</a>.
                    <?php }
                    if (isset($erreur)) {
                        ?><br/><br/>
                            <span style='color:red; flex-shrink: 0;'><?php echo $erreur; ?></span>
                    <?php }
                    ?>
                        </p>
                </form>
            </div>
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./repertoire.php"></a>
            <a id="buttonPdp" href="./Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
        </div>
    </body>
</html>

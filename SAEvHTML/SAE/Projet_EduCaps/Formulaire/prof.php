<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>EduCaps</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="./../css/style.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        <?php
        session_start();
        include_once './../connexion.php';
            if (isset($_REQUEST['cmdEnvoyer'])) {
                $done=false;
                $descF = $_REQUEST['txtMotiv'];
                $idU = $_SESSION['id'];
                $idTheme = $_REQUEST['lstTheme'];
                $dossierU = "./../PJ/$idU";
                if (!file_exists($dossierU)) {
                    mkdir($dossierU, 0777, true);
                }
                $fichiers = $_FILES['qualif'];
                if (is_array($fichiers)) {
                    $nbFile = count($fichiers['name']);
                } else {
                    $nbFile = 1;
                }
                for ($i = 0; $i < $nbFile; $i++) {
                    if ($fichiers['error'][$i] === 0) {
                        $nom = $fichiers['name'][$i];
                        $cheminTemp = $fichiers['tmp_name'][$i];
                        $nomU = time() . "_" . $nom;
                        $destination = $dossierU . "/" . basename($nomU);

                        if (move_uploaded_file($fichiers['tmp_name'][$i], $destination)) {
                            if(!$done){
                            $ordreSQLForm = "INSERT INTO Formulaire (descForm, idUser, idTheme) VALUES ('$descF', $idU, $idTheme) ";
                            $nb1 = $laConnexion->exec($ordreSQLForm);
                            $idForm = $laConnexion->lastInsertId();
                            $done=true;
                            }
                            if ($nb1 == 1) {
                                $ordreSQLDoc = "INSERT INTO Documents(idForm, nomDOc, cheminDoc) VALUES ($idForm, '$nom', '$destination')";
                                $nb2 = $laConnexion->exec($ordreSQLDoc);
                                if ($nb2 == 1) {
                                    $upload = "Votre demande à bien été prise en compte. Vous recevrez un mail lorsque votre demande aura été traité";
                                }
                                else {
                                    $upload = "Erreur lors de l'ajout dans la BDD de la pièce jointe. Veuillez recommencer ";
                                    $ordreSQL="DELETE FROM Formulaire WHERE idForm = $idForm";
                                    $nb=$laConnexion->exec($ordreSQL);
                                }
                            } else {
                                $uplaod = "Erreur lors de l'ajout dans la BDD du formulaire. Veuillez recommencer ";
                            }
                        } else {
                            $upload = "Upload de la pièce jointe " . $nom . "échoué";
                        }
                    } else {
                        $upload = "Erreur dans la pièce jointe " . $nom;
                    }
                }
            }
            ?>
        <div class="screen vertical-screen">
            <h1>Devenir Professeur</h1>
            <p class='txtFormulaire'>
                Afin de devenir professeur, vous aller devoir précisez vos motivations ainsi que justifier vos qualifications en joignant un ou plusieurs fichiers
                ceci peuvent être des diplomes, des peruves d'emplois...
                <br/><br/>
            </p>
            <br/>

            <form action='./prof.php' method='POST' class='formFormulaire' enctype="multipart/form-data">

                <textarea name='txtMotiv' rows='4' class='textAreaForm' maxlength='1000' required><?php if (!isset($upload)) { ?>Champs requis! Remplacez ce texte par vos motivations<?php } else {
                    echo $upload.". Remplacez ce texte par vos motivations";
                } ?></textarea>
                <br/><br/>
                <input type = 'file' name = 'qualif[]' class = "buttonLink" multiple required/>
                <br/><br/>
                <label>Theme : <select name="lstTheme">
                    <?php 
                    $ordreRecup="SELECT idTheme, nomTheme FROM Themes";
                    $resultat=$laConnexion->query($ordreRecup);
                    $themes=$resultat->fetchall();
                    foreach($themes as $theme){
                        ?>
                    <option value="<?php echo $theme['idTheme']; ?>"><?php echo $theme['nomTheme']; ?></option>
                    <?php }
                    ?>
                    </select></label>
                <br/>
                <br/>
                <button type = 'submit' name = 'cmdEnvoyer' value = 'Valider' class = 'buttonLink'>Valider</button>
            </form>

            
            <div class="navbar"></div>
            <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
            <div class="triangle"></div>
            <a class="rectangleL" href="./../php/repertoire.php"></a>
            <a id="buttonPdp" href="./../php/Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
        </div>
    </body>
</html>

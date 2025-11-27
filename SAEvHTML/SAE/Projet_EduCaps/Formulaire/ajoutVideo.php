<?php

session_start();
include_once './../connexion.php';

$titre = $_REQUEST["txtTitre"];
$desc = $_REQUEST['txtDesc'];
$idU = $_SESSION['id'];
$date = date("Y-m-d");
$themes = $_REQUEST['lstTheme'];
$themeA = [];

$dossierV = "./../Video/video/";
$nameV = $_FILES['video']['name'];
$uniqueNameV = time() . $nameV;
$cheminV = $dossierV . $uniqueNameV;
$origineV = $_FILES['video']['tmp_name'];

$dossierM = "./../Video/minia/";
$nameM = $_FILES['minia']['name'];
$uniqueNameM = time() . $nameM;
$cheminM = $dossierM . $uniqueNameM;
$origineM = $_FILES['minia']['tmp_name'];

if (move_uploaded_file($origineV, $cheminV) && move_uploaded_file($origineM, $cheminM)) {
    $ordreAjout1 = "INSERT INTO Video(titreVid,descVid,cheminVid,cheminMinia,auteurVid,datePubli) VALUES ('$titre','$desc','$cheminV','$cheminM',$idU,'$date')";
    $nb1 = $laConnexion->exec($ordreAjout1);
    if ($nb1 == 1) {
        $idVid = $laConnexion->lastInsertId();
        foreach ($themes as $theme) {
            $ordreAjout2 = "INSERT INTO Posseder VALUES ($theme,$idVid)";
            $nb2 = $laConnexion->exec($ordreAjout2);
            array_push($themeA, $theme);
            if ($nb2 == 0) {
                $ordreSuppr1 = "DELETE FROM Posseder WHERE idVid=$idVid";
                $ordreSuppr2 = "DELETE FROM Video WHERE idVid=$idVid";
                $nb1 = $laConnexion->exec($ordreSuppr1);
                $nb2 = $laConnexion->exec($ordreSuppr2);
                break;
            }
        }
    }
    else {
        $pb=true;
        echo "problème dans l'ajout dans la bdd de la video appuyez sur le lien retour ci dessous"; ?>
<a href="./nouvVideo.php">Retour</a>
<?php 
    }
}
else {
    $pb=true;
    echo "probleme dans l'ajout de la vidéo au serveur appuyer sur le lien retour ci dessous";
    ?> <a href="./nouvVideo.php">Retour</a>
    <?php
}

if (!$pb){
    header('Location: ./nouvVideo.php');
}
?>
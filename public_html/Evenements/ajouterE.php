<?php 
require './../Connexion/laConnexion.php'; 

session_start();

$recupTheme = $_POST['choixTheme']; 
$recupNomE = $_POST['nomEvent'];
$recupD = $_POST['description'];
$recupImg   = $_POST['choixImage']; 
$recupDateD = $_POST['dateDebut'];
$recupDateF = $_POST['dateFin'];
$recupU = $_SESSION['idU'];

$ordreSQL = "INSERT INTO Evenements (idT, titreE, descriptionE, numImage, dateE, DateF, idU) VALUES(:idTh, :nomE, :descript, :img, :dateD, :dateF, :idU)";
$RequeteP = $pdo->prepare($ordreSQL);
$RequeteP->bindValue(":idTh",  $recupTheme, PDO::PARAM_INT);
$RequeteP->bindValue(":nomE",  $recupNomE,  PDO::PARAM_STR);
$RequeteP->bindValue(":descript",  $recupD,     PDO::PARAM_STR);
$RequeteP->bindValue(":img",   $recupImg,   PDO::PARAM_INT);
$RequeteP->bindValue(":dateD", $recupDateD, PDO::PARAM_STR);
$RequeteP->bindValue(":dateF", $recupDateF, $recupDateF ? PDO::PARAM_STR : PDO::PARAM_NULL);
$RequeteP->bindValue(":idU",   $recupU,  PDO::PARAM_INT);

try {
        $RequeteP->execute();
        header("Location: ./ajoutEvents.php?success=ajoute");
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout : " . $e->getMessage();
    }
?>
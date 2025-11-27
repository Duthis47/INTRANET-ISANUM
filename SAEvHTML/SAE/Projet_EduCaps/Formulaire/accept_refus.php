<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './../vendor/autoload.php';
include_once './../connexion.php';

$action = $_REQUEST['btnChoix'];
$idUser = $_REQUEST['id'];
$idTheme = $_REQUEST['idTheme'];
$mail = new PHPMailer(true);
$envoyer= false;
$destinataire = $_REQUEST['mailU'];
$modif=1;
$faire = true;
if ($action == "Accepter") {
    $ordreVerif = "SELECT idTheme FROM Qualifier WHERE idUSer=$idUser";
    $result=$laConnexion->query($ordreVerif);
    $verific=$result->fetchall();
    foreach($verific as $verif){
        if ($verif['idTheme'] == $idTheme){
            $faire = false;
            $action = "Refuser";
        }
    }
    if ($faire == true){
    $ordreSQL0="UPDATE Users SET typeU='prof' WHERE idUser=$idUser";
    $nb0=$laConnexion->exec($ordreSQL0);
    $ordreSQL01="INSERT INTO Qualifier VALUES ($idUser, $idTheme)";
    $nb01=$laConnexion->exec($ordreSQL01);
    if ($nb01 == 1){
        $ordreSuppr="SELECT cheminDoc FROM Documents JOIN Formulaire ON Documents.idForm = Formulaire.idForm WHERE Formulaire.idUser = $idUser";
        $r=$laConnexion->query($ordreSuppr);
        $aSupp=$r->fetchall();
        foreach($aSupp as $supp){
            unlink($supp['cheminDoc']);
        }
        $ordreSQL1 = "DELETE Documents FROM Documents JOIN Formulaire ON Documents.idForm = Formulaire.idForm WHERE Formulaire.idUser = $idUser";
        $nb1 = $laConnexion->exec($ordreSQL1);
        if ($nb1 == 0) {
            echo "Problème lors de la suppression des docs";
        } else {
            $ordreSQL2 = "DELETE FROM Formulaire WHERE Formulaire.idUser = $idUser";
            $nb2 = $laConnexion->exec($ordreSQL2);
            if ($nb2 == 0) {
                echo "Probleme lors de la suppression du Formulaire";
            } else {
                $sujet = "Demande de considération en tant que professeur";
                $message = "Monsieur, madame, \nNous avons le plaisir de vous annoncer que votre demande de considération en tant que professeur a été accepté.\n"
                        . "Nous esperons que vous prendrez ce role au sérieux en ajoutant des vidéos susceptibles d'intéresser les étudiants.\n"
                        . "Cordialement\n"
                        . "EduCaps";
                $envoyer = true;
            }
        }
    }
}
}
if ($action == "Refuser") {
    $ordreSuppr="SELECT cheminDoc FROM Documents JOIN Formulaire ON Documents.idForm = Formulaire.idForm WHERE Formulaire.idUser = $idUser";
    $r=$laConnexion->query($ordreSuppr);
    $aSupp=$r->fetchall();
    foreach($aSupp as $supp){
        unlink($supp['cheminDoc']);
    }
    $ordreSQL1 = "DELETE Documents FROM Documents JOIN Formulaire ON Documents.idForm = Formulaire.idForm WHERE Formulaire.idUser = $idUser";
    $nb1 = $laConnexion->exec($ordreSQL1);
    if ($nb1 == 0) {
        echo "Problème lors de la suppression des docs";
    } else {
        $ordreSQL2 = "DELETE FROM Formulaire WHERE Formulaire.idUser = $idUser";
        $nb2 = $laConnexion->exec($ordreSQL2);
        if ($nb2 == 0) {
            echo "Probleme lors de la suppression du Formulaire";
        } else {
            $sujet = "Demande de considération en tant que professeur";
            $message = "Monsieur, madame, \nNous avons le regret de vous annoncer que votre demande de considération en tant que professeur ne correspond pas à ce que nous recherchons.\n"
                    . "Vous pouvez toujours réessayez en donnant plus d'informations quand à vos motivations ou bien en partageant des justificatifs plus convaincant.\n"
                    . "Cordialement\n"
                    . "EduCaps";
            $envoyer = true;
        }
    }
} 
if (!$faire){
    $message = "Monsieur, madame, étant donné que vous êtes déja professeur dans ce domaine, je vous prierais de ne pas refaire de demande afin d'être reconsidérée professeur dans un domaine ou vous l'êtes déja. \n"
            . "Cordialement\n"
            . "EduCaps";
}

if ($envoyer) {
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'educaps64@gmail.com';
        $mail->Password = 'pnwx artl rvsk mlof';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('educaps64@gmail.com', 'AdminEduCaps');
        $mail->addAddress($destinataire, "étudiant");

        $mail->isHTML(true);
        $mail->Subject = $sujet;
        $mail->Body = $message;
        $mail->AltBody = $message;
        
        $mail->send();
        echo "Le message est bien envoyé cliqué sur le lien ci-dessous pour revenir sur le site";
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
    }
    ?> <br/><br/><a href="./listeDemande.php">Retour</a>
<?php
}
?>

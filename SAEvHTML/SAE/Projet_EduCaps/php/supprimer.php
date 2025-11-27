<?php

session_start();
include_once './../connexion.php';

$idVideo=$_REQUEST['id'];
$cheminV=$_REQUEST['cheminV'];
$cheminM=$_REQUEST['cheminM'];
if(unlink($cheminM) && unlink($cheminV)){
    $ordreVide1="DELETE FROM Video WHERE idVid=$idVideo";
    $ordreVide2="DELETE FROM Posseder WHERE idVid=$idVideo";
    $nb1=$laConnexion->exec($ordreVide2);
    $nb2=$laConnexion->exec($ordreVide1);
    if ($nb1==0 || $nb2==0){
        echo "Problème lors de la suppression des occurences de la bdd";
    }
    else {
        header('Location: ./../index.php');
        exit;
    }
}
else {
    echo "Probleme lors de la suppression de la vidéo";
}

?>
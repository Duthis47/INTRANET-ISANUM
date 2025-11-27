<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$action = $_REQUEST['cmdRedirect'];

if ($action === "Deconnexion"){
    include_once 'deconnexion.php';
    exit;
}
else if ($action === "Prof"){
    header('Location: ./../Formulaire/prof.php');
    exit;
}
else if ($action === "Info"){
    header('Location: ./../Formulaire/info.php');
    exit;
}
else if ($action === "Accepter"){
    header('Location: ./../Formulaire/listeDemande.php');
    exit;
}
else if ($action === "Video"){
    header('Location: ./../Formulaire/nouvVideo.php');
    exit;
}
else {
    header('Location: ./utilisateur.php');
    exit;
}
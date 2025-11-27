<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<?php
    try {
        $laConnexion=new PDO("mysql:host=localhost;dbname=EduCaps","adminer","Isanum64!");
        $laConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $error) {
        die("Erreur de connexion à la BDD : ". $error->getMessage());
    }
    ?>


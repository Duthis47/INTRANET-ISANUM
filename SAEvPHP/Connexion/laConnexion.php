<?php

try {
    $Connexion = new PDO('mysql:host=localhost;dbname=ISANET', 'adminer', 'Isanum64!', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $erreur) {
    die("Erreur de connexion : " . $erreur->getMessage());
}
?>


<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>;
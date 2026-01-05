<?php

try {
    $pdo = new PDO('mysql:host=10.3.17.220;dbname=ISANET', 'Admin', 'L@SNUM', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $erreur) {
    die("Erreur de connexion : " . $erreur->getMessage());
}
?>



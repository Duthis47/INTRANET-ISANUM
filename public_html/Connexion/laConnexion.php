<?php

try {
    $pdo = new PDO('mysql:host=db;dbname=ISANET', getenv('BDD_USER'), getenv('BDD_PASSWORD'),[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $erreur) {
    die("Erreur de connexion : " . $erreur->getMessage());
}
?>



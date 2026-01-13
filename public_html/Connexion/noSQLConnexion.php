<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// Récupération des variables d'environnement définies dans le docker-compose ou le .env
$user = getenv('MONGO_USER') ?: 'root';
$pass = getenv('MONGO_PASSWORD') ?: 'example';
$host = "db_noSQL"; // Le nom du service dans docker-compose

// Construction de l'URI avec les variables
$uri = sprintf(
    "mongodb://%s:%s@%s:27017/?authSource=admin",
    $user,
    $pass,
    $host
);

try {
    $mongo = new MongoDB\Client($uri);
    $mongoDB = $mongo->ISANET;
} catch (Exception $e) {
    die("Erreur de connexion MongoDB : " . $e->getMessage());
}
?>
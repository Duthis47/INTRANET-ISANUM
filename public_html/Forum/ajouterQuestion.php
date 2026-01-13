<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);


require "../Connexion/noSQLConnexion.php"; 
require "../Connexion/laConnexion.php";    

if (!isset($_SESSION['idU'])) {
    header("Location: /Authentification/login.php");
    exit();
}

$questions = $mongoDB->forum_questions;
$reponses  = $mongoDB->forum_reponses;

$idU = $_SESSION['idU'];

$stmt = $pdo->prepare("SELECT prenomU FROM Utilisateurs WHERE idU = ?");
$stmt->execute([$idU]);



$username = $stmt->fetchColumn() ?: 'Utilisateur';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = trim($_POST['question'] ?? '');

    if ($titre === '' || empty($titre)) {
        $erreur = "Remplir ce champ.";
    } else {

        // Insertion MongoDB
        $questions->insertOne([
            "titre" => $titre,
            "user_id" => (int) $_SESSION['idU'],
            "date_creation" => new MongoDB\BSON\UTCDateTime()
        ]);

        // Redirection vers la liste des questions
        header("Location: questionsForum.php");
        exit();
    }
}

?>


<!doctype html>
<html lang="fr" >

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1" />
        <meta name="description" content="" />

        <title>Forum</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

        <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
        <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
        <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />



        <link href="./../Style/css/style.css" rel="stylesheet" />
    </head>

    <body>

        <?php
            include './../main/header.php';
        ?>

        <div class="container">
            <main>
                <div class="p-5 text-center">

        <!-- Titre -->
        <h1 class="fw-bold mb-3">Ajouter une question</h1>

        <!-- Texte explicatif -->
        <p class="text-muted mb-5">
            Cette rubrique permet d'ajouter une question à la partie Forum.
            Elle regroupe les questions fréquentes ou redondantes afin de centraliser
            les réponses utiles au cours de vos études.
        </p>

        <!-- Sous-titre -->
        <h5 class="text-start mb-3">Entrez une question pas encore mise</h5>
        <hr>

        <!-- Formulaire -->
        <form method="post">

            <div class="mb-4 text-start">
                <label class="form-label fw-semibold">Question</label>
                <input type="text"
                       name="question"
                       class="form-control"
                       required>
            </div>

            <hr>

            <button type="submit" class="btn btn-primary w-100 py-2">
                Ajouter
            </button>

        </form>

    </div>

    </main>


    <br>
    <br>


</div>

<script src="./checkout.js" class="astro-vvvwv3sm"></script>
</body>

</html>


<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

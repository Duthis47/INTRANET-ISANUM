<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "../Connexion/noSQLConnexion.php"; // connexion MongoDB
require "../Connexion/laConnexion.php";  // connexion SQL

// Sélection de la collection "questions" dans la base de données
$questions = $mongoDB->forum_questions;
$reponses  = $mongoDB->forum_reponses;

// Récupération des questions du forum (ordre récent → ancien)
$listeQuestions = iterator_to_array(
    $questions->find([], ["sort" => ["date_creation" => -1]])
);

if (!isset($_SESSION['idU'])) {
    header("Location:http://10.3.17.217:8090/Authentification/login.php");
    exit();
}





?>



<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISA NET - Forum</title>



    <!-- Début des imports Boostraps-->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />



    <link href="./../Style/css/style.css" rel="stylesheet" />

    <!--Fin des imprts bootstraps-->

</head>


<body>

    <?php 
        include './../main/header.php';
    ?>


    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">

            <h1 class="display-5 fw-semibold text-center mb-4">
                Les questions
            </h1>
        <!-- Bouton nouvelle question -->
        <?php if (isset($_SESSION["idU"])){ ?>
            <div class="text-center mb-4">
                <a href="ajouterQuestion.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nouvelle question
                </a>
            </div>
        <?php } ?>

            <!-- Barre de recherche -->
            <form class="d-flex justify-content-center mb-4" role="search" onsubmit="return false;">
                <div class="input-group input-group-forum" style="max-width: 400px;">
                    <span class="input-group-text input-group-text-forum bg-light">
                        <i class="bi bi-search"></i>
                    </span>
                    <input id="searchInput" class="form-control" type="search" placeholder="Rechercher une question..."
                        aria-label="Search">
                </div>
            </form>
 <!-- Liste des questions -->
        <div id="questionList" class="row">
            <div class="col-lg-6 px-4">
                <?php
                $i = 0;
                foreach ($listeQuestions as $q){
                    $idU = $q['user_id'] ?? null;
                    $username = 'Utilisateur';

                    if ($idU !== null) {
                        $stmt = $pdo->prepare("SELECT prenomU FROM Utilisateurs WHERE idU = ?");
                        $stmt->execute([$idU]);
                        $username = $stmt->fetchColumn() ?: 'Utilisateur';
                    }
                    if ($i === ceil(count($listeQuestions) / 2)) {
                        echo '</div><div class="col-lg-6 px-4">';
                    }
                ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <a href="Forum.php?idQ=<?= $q['_id'] ?>"
                           class="text-decoration-none flex-grow-1">
                            <p class="lead mb-0 d-block">
                                <?= htmlspecialchars($q["titre"]) ?>
                            </p>
                            <small class="text-muted">
                                Par <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?> ·
                                <?= $q["date_creation"]
                                    ->toDateTime()
                                    ->format("d/m/Y H:i") ?>
                            </small>
                        </a>
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </div>
        </div>
    </main>

    <?php 
    include './../main/footer.php';
    ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>
    <script src="./../Accueil.js"></script>
    <script src="./searchB.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

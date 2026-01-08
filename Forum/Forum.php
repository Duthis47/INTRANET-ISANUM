<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "../Connexion/noSQLConnexion.php";
require "../Connexion/laConnexion.php";

if (!isset($_SESSION['idU'])) {
    header("Location: ../Authentification/login.php");
    exit();
}

if (!isset($_GET['idQ'])) {
    die("Question invalide");
}

use MongoDB\BSON\ObjectId;

$idQ = new ObjectId($_GET['idQ']);

$questions = $mongoDB->forum_questions;
$reponses  = $mongoDB->forum_reponses;
$question = $questions->findOne(['_id' => $idQ]);
if (!$question) {
    die("Question non trouvée");
}

$listeReponses = iterator_to_array(
    $reponses->find(
        ["idQ" => $idQ],
        ["sort" => ["date_creation" => 1]]
    )
);

$questionsSidebar = iterator_to_array(
    $questions->find(
        [],
        [
            'sort'  => ['date_creation' => -1],
            'limit' => 5
        ]
    )
);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $contenu = trim($_POST['reponse'] ?? '');

    if ($contenu !== '') {
        $reponses->insertOne([
            "idQ" => $idQ,
            "contenu" => $contenu,
            "user_id" => (int) $_SESSION['idU'],
            "date_creation" => new MongoDB\BSON\UTCDateTime()
        ]);

        header("Location: Forum.php?idQ=" . $_GET['idQ']);
        exit();
    }
}

function getUsername(PDO $pdo, int $idU): string {
    $stmt = $pdo->prepare("SELECT prenomU FROM Utilisateurs WHERE idU = ?");
    $stmt->execute([$idU]);
    return $stmt->fetchColumn() ?: 'Utilisateur';
}

?>



<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>ISA NET - Forum</title>

    <!--Imports Bootstraps-->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

    <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
    <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
    <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />


    <link href="./../Style/css/Forum.css" rel="stylesheet" />


    <link href="./../Style/css/style.css" rel="stylesheet" />
</head>


<body>

    <?php
    include './../main/header.php';
    ?>




    <main>
        <aside>

            <h2>Questions</h2>
            <br>

            <?php if (empty($questionsSidebar)) {  ?>
                <p class="text-muted">Aucune question</p>
            <?php } ?>

            <?php foreach ($questionsSidebar as $q) { ?>
                <p>
                    <a href="Forum.php?idQ=<?= $q['_id'] ?>"
                    class="text-decoration-none">
                        <?= htmlspecialchars($q['titre'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </p>
            <?php } ?>

            <hr>

            <a href="questionsForum.php"
            class="btn btn-link rounded-pill px-3">
                voir plus
            </a>

        </aside>


        <div id="content">
            

            <!-- QUESTION CHOISIE -->
            <div id="post">
                <div id="placeholder" class="text-align-center">
                    <?= htmlspecialchars($question['titre'], ENT_QUOTES, 'UTF-8') ?>
                    <br>
                    <small>
                        Par <?= htmlspecialchars(getUsername($pdo, $question['user_id']), ENT_QUOTES, 'UTF-8') ?>
                        · <?= $question['date_creation']->toDateTime()->format("d/m/Y H:i") ?>
                    </small>
                </div>
            </div>

            <!-- RÉPONSES -->
            <?php if (empty($listeReponses)): ?>
                <article>
                    <p class="text-muted">Aucune réponse pour le moment.</p>
                </article>
            <?php endif; ?>

            <?php foreach ($listeReponses as $r){ ?>
                <article class="message-slide">
                    <h2>
                        <?= htmlspecialchars(getUsername($pdo, $r['user_id']), ENT_QUOTES, 'UTF-8') ?>
                    </h2>

                    <p>
                        <?= nl2br(htmlspecialchars($r['contenu'], ENT_QUOTES, 'UTF-8')) ?>
                    </p>

                    <p class="text-muted">
                        le <?= $r['date_creation']->toDateTime()->format("d/m/Y") ?>
                    </p>
                </article>
            <?php } ?>

            <!-- ZONE RÉPONDRE -->
            <section class="forum-input d-flex justify-content-center align-items-center p-3 border-top mt-4">
                <form method="post" class="d-flex w-100 justify-content-center">
                    <textarea name="reponse"
                            class="form-control me-2 w-75"
                            placeholder="Écrire un message..."
                            required></textarea>

                    <button class="btn btn-primary">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </form>
            </section>

        </div>

        <a href="http://10.3.17.220/SAE/Forum/ajouterQuestion.php" class="btn btn-primary btn-floating" id="btn-fixed">
            Ajouter une question
        </a>
    </main>

    <?php
    include './../main/footer.php';
    ?>
    <script src="./forum.js">

    </script>
</body>

</html>
<?php
session_start();

require '../Connexion/laConnexion.php';  
require '../Connexion/noSQLConnexion.php'; 

if (!isset($_SESSION['idU'])) {
    header("Location: http://10.3.17.220/SAE/Authentification/login.php");
    exit();
}

//recup des paramètres
if (!isset($_GET['Matiere'])) {
    die("Matière non définie");
}
$idM = (int) $_GET['Matiere'];

//requte pour avoir les infos de la matière
$sql = "SELECT Matiere.nomM, Formation.nomF FROM Matiere JOIN Formation ON Matiere.idF = Formation.idF WHERE Matiere.idM = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idM]);
$matiere = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$matiere) {
    die("Matière inconnue");
}

//requetes NoSQL pour récupérer les cours
$collectionDocs = $mongoDB->cours;
$documents = $collectionDocs->find(
    ['idM' => $idM],
    ['sort' => ['date' => -1]]
);
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>ISA NET <?= htmlspecialchars($matiere['nomM']) ?></title>

        <!-- Début des imports Boostraps-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
        <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
        <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./../Style/navbars-offcanvas.css" rel="stylesheet" />
        <link href="./../Style/css/style.css" rel="stylesheet" />


        <!--Fin des imports bootstraps-->

    </head>

    <body>
        
        <?php
            include './../main/header.php';
        ?>

        <main class="container">
            <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">


                <h1 class="display-4 fw-medium text-center mb-5">
                    <strong><?= htmlspecialchars($matiere['nomF']) ?> — <?= htmlspecialchars($matiere['nomM']) ?></strong>
                </h1>

                <?php if (iterator_count($documents) === 0): ?>
                    <div class="alert alert-info text-center">
                        Aucun document disponible pour cette matière.
                    </div>
                <?php else: ?>
                            <div class="list-group">

                    <?php foreach ($documents as $doc): ?>
                        <a href="/SAE/Cours/<?= htmlspecialchars($doc['chemin']) ?>"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        target="_blank">

                            <div>
                                <strong><?= htmlspecialchars($doc['titre']) ?></strong><br>
                                <small class="text-muted">
                                    <?= htmlspecialchars($doc['type']) ?>
                                    <?php if (!empty($doc['description'])): ?>
                                        — <?= htmlspecialchars($doc['description']) ?>
                                    <?php endif; ?>
                                </small>
                            </div>

                            <i class="bi bi-download fs-4"></i>
                        </a>
                    <?php endforeach; ?>

                </div>
                <?php endif; ?>


                <div class="row">


                </div>
            </div>
        </main>

        <?php 
            include './../main/footer.php';
        ?>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
</body>

</html>


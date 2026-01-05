<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('./../Connexion/laConnexion.php');
include_once ('./../Connexion/noSQLConnexion.php');


if (!isset($_SESSION['idU'])) {
    header("Location: http://10.3.17.220/SAE/Authentification/login.php");
    exit();
}
$ordreSQL="SELECT nomM FROM Matiere WHERE idM =:idMatiere ";
$RequeteP=$pdo->prepare($ordreSQL);
$idMat = (int)$_REQUEST['Matiere'];
$RequeteP->bindValue(":idMatiere",$idMat,PDO::PARAM_INT);
$RequeteP->execute();
$resultNM = $RequeteP->fetch();
$idForm = (int)$_REQUEST['Formation'];


if (!$idMat) {
    die("Matière inconnue");
}

//requetes NoSQL pour récupérer les cours
$collectionDocs = $mongoDB->cours;
$documents = $collectionDocs->find(
    ['idM' => $idMat],
    ['sort' => ['date' => -1]]
);

?>

<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1" />
        <meta name="description" content="" />
        <title>ISA NET - Cours</title>
        <!--Nav Bar-->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
        <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
        <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./../Style/css/style.css" rel="stylesheet" />

        <!--Fin import Nav Bar-->
    </head>

    <body>

        <?php
        include './../main/header.php';
        ?>

        <main class="container">
            <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">


                <h1 class="display-4 fw-medium text-center mb-5">
                    <strong>ISA NUM <?php echo $idForm ?> - <?php echo $resultNM['nomM']; ?></strong>
                </h1>


                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    foreach ($documents as $doc) {
                        ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($doc["titre"]); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($doc['description']); ?></p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="/SAE/Cours/<?php echo htmlspecialchars($doc['chemin']); ?>" target="_blank" class="btn btn-primary">Voir le document</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

            </div>
        </main>       
    </body>
</html>
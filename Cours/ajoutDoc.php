<?php
session_start();

require '../Connexion/laConnexion.php';     // Connexion SQL
require '../Connexion/noSQLConnexion.php';  // Connexion MongoDB

if (!isset($_SESSION['idU'])) {
    header("Location: /SAE/Authentification/login.php");
    exit();
}

$collectionDocs = $mongoDB->cours;

$sql = "SELECT Matiere.idM, Matiere.nomM, Formation.nomF FROM Matiere JOIN Formation ON Matiere.idF = Formation.idF";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idM         = (int) $_POST['idM'];
    $type        = $_POST['type'];
    $titre       = trim($_POST['titre']);
    $description = trim($_POST['description']);

    //check si formulaire complet
    if (empty($idM) || empty($type) || empty($titre) || !isset($_FILES['document'])
    ) {
        die("Formulaire incomplet");
    }

    //check type fichier
    if ($_FILES['document']['type'] !== 'application/pdf') {
        die("Seuls les fichiers PDF sont autorisés");
    }
    //setup du dossier de stockage
    $dossier = realpath(__DIR__ . '/Cours');

    if ($dossier === false) {
        die("Dossier de stockage introuvable");
    }

    if (!is_writable($dossier)) {
        die("Dossier non accessible en écriture");
    }
    //création nom fichier de cours unique
    $nomFichier = uniqid('cours_') . '.pdf';
    $cheminServeur = $dossier . '/' . $nomFichier;
    $cheminPublic  = 'Cours/' . $nomFichier;


    

    //verrif de l'upload et déplacement
    if (!move_uploaded_file($_FILES['document']['tmp_name'], $cheminServeur)) {
        die("Erreur lors du téléversement");
    }

    //Insertion dans le NoSQL
    $collectionDocs->insertOne([
        'idM'         => $idM,
        'type'        => $type,
        'titre'       => $titre,
        'description' => $description,
        'chemin'      => $cheminPublic,
        'date'        => new MongoDB\BSON\UTCDateTime()
    ]);

    header("Location: cours.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ISA NET - Ajouter un document</title>

    <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./../Style/css/style.css" rel="stylesheet">
</head>

<body>

<?php include './../main/header.php'; ?>
<main class="container">
    <div class="py-5 text-center">
        <h2>Ajouter un document de cours</h2>
        <p class="lead">Remplissez le formulaire ci-dessous pour ajouter un nouveau document de cours.</p>
    </div>

    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Informations</h4>
            <form class="needs-validation" action="ajoutDoc.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="idM" class="form-label">Matière</label>
                        <select class="form-select" id="idM" name="idM" required>
                            <option value="">Choisir...</option>
                            <?php foreach ($matieres as $matiere): ?>
                                <option value="<?= htmlspecialchars($matiere['idM']) ?>">
                                    <?= htmlspecialchars($matiere['nomF'] . ' - ' . $matiere['nomM']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            Veuillez sélectionner une matière.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="type" class="form-label">Type de document</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Choisir...</option>
                            <option value="Cours">Cours</option>
                            <option value="TD">TD</option>
                            <option value="Exercice">Exercice</option>
                        </select>
                        <div class="invalid-feedback">
                            Veuillez sélectionner un type de document.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre du document" required>
                        <div class="invalid-feedback">
                            Veuillez fournir un titre pour le document.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Brève description du document"></textarea>
                    </div>

                    <div class="col-12">
                        <label for="document" class="form-label">Fichier PDF</label>
                        <input class="form-control" type="file" id="document" name="document" accept="application/pdf" required>
                        <div class="invalid-feedback">
                            Veuillez télécharger un fichier PDF.
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <button class="btn btn-primary btn-lg" type="submit">Ajouter le document</button>
            </form>
        </div>
    </div>
</main>
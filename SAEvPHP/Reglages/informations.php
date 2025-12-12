<?php
session_start();

// 1. GESTION DES MESSAGES (Pour afficher les succès/erreurs après traitement)
$msg_success = null;
$msg_error = null;

if (isset($_SESSION['msg_success'])) {
    $msg_success = $_SESSION['msg_success'];
    unset($_SESSION['msg_success']);
}

if (isset($_SESSION['msg_error'])) {
    $msg_error = $_SESSION['msg_error'];
    unset($_SESSION['msg_error']);
}

// 2. LOGIQUE DE NAVIGATION SÉCURISÉE
// Ajoutez ici les noms de TOUTES vos pages (correspondant aux fichiers dans le dossier 'vues')
$pages_autorisees = ['infos', 'notifications', 'email', 'mot2passe'];

// Vérification : Si la page demandée existe dans la liste, on la charge. Sinon, on charge 'infos'.
$page_actuelle = isset($_GET['page']) && in_array($_GET['page'], $pages_autorisees) ? $_GET['page'] : 'infos';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISA NET - Paramètres</title>

    <link href="./../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    
    <link rel="stylesheet" href="./../Style/styleFooter.css" />
    <link href="./../Style/navbars-offcanvas.css" rel="stylesheet" />
    <link href="./style.css" rel="stylesheet">
    <link rel="stylesheet" href="/SAE/Style/css/style.css">
    <script src="./../assets/js/color-modes.js"></script>
</head>

<body>

    <?php include './../main/header.php'; ?>

    <div class="d-flex min-vh-100">

        <aside class="sidebar d-none d-lg-block border-end">
            <h5>Général</h5>
            <div class="list-group list-group-flush">
                <a href="vues/infos.php" 
                   class="list-group-item list-group-item-action <?= $page_actuelle == 'infos' ? 'active' : '' ?>">
                   Informations
                </a>
                <a href="vues/notifications.php" 
                   class="list-group-item list-group-item-action <?= $page_actuelle == 'notifications' ? 'active' : '' ?>">
                   Notifications
                </a>
            </div>

            <h5 class="mt-4">Compte</h5>
            <div class="list-group list-group-flush">
                <a href="vues/email.php" 
                   class="list-group-item list-group-item-action <?= $page_actuelle == 'email' ? 'active' : '' ?>">
                   E-mail
                </a>
                <a href="vues/mot2passe.php" 
                   class="list-group-item list-group-item-action <?= $page_actuelle == 'mot2passe' ? 'active' : '' ?>">
                   Mot de passe
                </a>
            </div>
            
            <h5 class="mt-4">A suivre</h5>
            <div class="list-group list-group-flush mb-4">
                <a href="#" class="list-group-item list-group-item-action">...</a>
            </div>
        </aside>

        <main class="d-flex flex-column flex-grow-1 position-relative">
            
            <div class="d-lg-none ms-3 mt-4 mb-4 position-absolute" style="z-index: 1050;">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAside"
                    aria-controls="offcanvasAside">
                    <i class="bi bi-gear-fill"></i>
                </button>
            </div>

            <?php 
                // C'est ICI que la magie opère pour accéder à toutes les pages
                // On construit le chemin vers le fichier dans le dossier 'vues'
                $chemin_fichier = "vues/$page_actuelle.php";

                if (file_exists($chemin_fichier)) {
                    include $chemin_fichier;
                } else {
                    // Message d'erreur utile si le fichier manque
                    echo "<div class='alert alert-danger m-5'>
                            Erreur 404 : Le fichier <strong>$chemin_fichier</strong> n'a pas été trouvé.<br>
                            Vérifiez qu'il existe bien dans le dossier 'vues'.
                          </div>";
                }
            ?>
            
        </main>

    </div>

    <div class="offcanvas offcanvas-start" style="background-color: #2c2f33;" tabindex="-1" id="offcanvasAside" aria-labelledby="offcanvasAsideLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAsideLabel" class="text-white">Menu Paramètres</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group list-group-flush">
                <a href="vues/infos.php" class="list-group-item list-group-item-action <?= $page_actuelle == 'infos' ? 'active' : '' ?>">Informations</a>
                <a href="vues/notifications.php" class="list-group-item list-group-item-action <?= $page_actuelle == 'notifications' ? 'active' : '' ?>">Notifications</a>
                <a href="vues/email.php" class="list-group-item list-group-item-action <?= $page_actuelle == 'email' ? 'active' : '' ?>">E-mail</a>
                
                <a href="vues/mot2passe.php" class="list-group-item list-group-item-action <?= $page_actuelle == 'mot2passe' ? 'active' : '' ?>">Mot de passe</a>
            </div>
        </div>
    </div>

    <?php include './../main/informations.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./parametres.js"></script>

</body>
</html>

<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>;

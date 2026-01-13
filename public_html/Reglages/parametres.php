<?php

if (!isset($_SESSION)){
    session_start();
}
// Vérifiez bien ce chemin vers votre connexion
require '../Connexion/laConnexion.php'; 

// --- 1. SÉCURITÉ & INIT ---
if (!isset($_SESSION['idU'])) {
    header("Location: ../Authentification/login.php");
    exit();
}

$idUser = $_SESSION['idU'];
$msg_success = null;
$msg_error = null;

// --- 2. ROUTAGE (Navigation) ---
$page_actuelle = 'infos'; // Page par défaut
$pages_autorisees = ['infos', 'notifications', 'email', 'mot2passe'];

if (isset($_GET['page']) && in_array($_GET['page'], $pages_autorisees)) {
    $page_actuelle = $_GET['page'];
}

// --- 3. TRAITEMENT DES FORMULAIRES (LOGIQUE) ---

// A. Mise à jour INFOS
if (isset($_POST['btn_update_infos'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $idF = intval($_POST['year']);

    try {
        $sql = "UPDATE Utilisateurs SET nomU = :nom, prenomU = :prenom, idF = :idF WHERE idU = :idU";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'idF' => $idF, 'idU' => $idUser]);
        
        $_SESSION['nomU'] = $nom;
        $_SESSION['prenomU'] = $prenom;
        $_SESSION['idF'] = $idF;
        
        $msg_success = "Informations mises à jour.";
    } catch (PDOException $e) {
        $msg_error = "Erreur SQL : " . $e->getMessage();
    }
}

// B. Mise à jour MOT DE PASSE
if (isset($_POST['btn_update_password'])) {
    $old_pwd = $_POST['old_password'];
    $new_pwd = $_POST['new_password'];
    $conf_pwd = $_POST['confirm_password'];

    // On récupère le MDP actuel pour vérifier
    $stmt = $pdo->prepare("SELECT mdpU FROM Utilisateurs WHERE idU = ?");
    $stmt->execute([$idUser]);
    $verifUser = $stmt->fetch();

    if (password_verify($old_pwd, $verifUser['mdpU'])) {
        if ($new_pwd === $conf_pwd) {
            $new_hash = password_hash($new_pwd, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE Utilisateurs SET mdpU = ? WHERE idU = ?");
            $update->execute([$new_hash, $idUser]);
            $msg_success = "Mot de passe modifié.";
        } else {
            $msg_error = "Les nouveaux mots de passe ne correspondent pas.";
        }
    } else {
        $msg_error = "L'ancien mot de passe est incorrect.";
    }
}

// C. Mise à jour EMAIL
if (isset($_POST['btn_update_email'])) {
    $new_email = filter_var($_POST['new_email'], FILTER_SANITIZE_EMAIL);
    $verif_pwd = $_POST['verif_password'];

    $stmt = $pdo->prepare("SELECT mdpU FROM Utilisateurs WHERE idU = ?");
    $stmt->execute([$idUser]);
    $verifUser = $stmt->fetch();

    if (password_verify($verif_pwd, $verifUser['mdpU'])) {
        try {
            $update = $pdo->prepare("UPDATE Utilisateurs SET mailU = ? WHERE idU = ?");
            $update->execute([$new_email, $idUser]);
            $_SESSION['mailU'] = $new_email;
            $msg_success = "Adresse e-mail mise à jour.";
        } catch (PDOException $e) {
            $msg_error = "Cet email est peut-être déjà utilisé.";
        }
    } else {
        $msg_error = "Mot de passe incorrect.";
    }
}

// --- 4. RÉCUPÉRATION DES DONNÉES UTILISATEUR (Pour affichage) ---
$stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE idU = ?");
$stmt->execute([$idUser]);
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres</title>
    <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href="./style.css" rel="stylesheet">
    <link href="./../Style/css/Accueil.css" rel="stylesheet">
</head>

<body>

    <?php include './../main/header.php'; ?>

    <div class="d-flex">
        
        <aside class="sidebar d-none d-lg-block">
            <h5>Général</h5>
            <div class="list-group list-group-flush">
                <a href="?page=infos" class="list-group-item list-group-item-action <?= $page_actuelle == 'infos' ? 'active' : '' ?>">
                    <i class="bi bi-person me-2"></i> Informations
                </a>
                <a href="?page=notifications" class="list-group-item list-group-item-action <?= $page_actuelle == 'notifications' ? 'active' : '' ?>">
                    <i class="bi bi-bell me-2"></i> Notifications
                </a>
            </div>

            <h5>Sécurité</h5>
            <div class="list-group list-group-flush">
                <a href="?page=email" class="list-group-item list-group-item-action <?= $page_actuelle == 'email' ? 'active' : '' ?>">
                    <i class="bi bi-envelope me-2"></i> E-mail
                </a>
                <a href="?page=mot2passe" class="list-group-item list-group-item-action <?= $page_actuelle == 'mot2passe' ? 'active' : '' ?>">
                    <i class="bi bi-key me-2"></i> Mot de passe
                </a>
            </div>
        </aside>

        <main class="flex-grow-1 py-5 px-3">
            
            <div class="d-lg-none mb-4">
                <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
                    <i class="bi bi-list"></i> Menu
                </button>
            </div>

            <div class="settings-container">
                
                <?php if ($msg_error): ?>
                    <div class="alert alert-danger mb-4"><?= $msg_error ?></div>
                <?php endif; ?>
                <?php if ($msg_success): ?>
                    <div class="alert alert-success mb-4"><?= $msg_success ?></div>
                <?php endif; ?>


                <?php if ($page_actuelle == 'infos'): ?>
                    <h2 class="mb-4 text-center">Mes Informations</h2>
                    <form method="POST" action="?page=infos">
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control" 
                                       value="<?= htmlspecialchars($currentUser['nomU']); ?>" required>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" id="prenom" name="prenom" class="form-control" 
                                       value="<?= htmlspecialchars($currentUser['prenomU']); ?>" required>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="year" class="form-label">Année de formation</label>
                                <select class="form-select" id="year" name="year">
                                    <?php 
                                    $curIdF = $currentUser['idF'] ?? 1;
                                    for ($i = 1; $i <= 5; $i++): ?>
                                        <option value="<?= $i ?>" <?= ($curIdF == $i) ? 'selected' : '' ?>>
                                            ISA NUM <?= $i ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" name="btn_update_infos" class="btn btn-primary rounded-pill px-5">Enregistrer</button>
                        </div>
                    </form>

                <?php elseif ($page_actuelle == 'mot2passe'): ?>
                    <h2 class="mb-4 text-center">Sécurité</h2>
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            <h5 class="mb-3 text-white">Changer le mot de passe</h5>
                            <form method="POST" action="?page=mot2passe">
                                <div class="mb-3 text-start">
                                    <label class="form-label">Ancien mot de passe</label>
                                    <input type="password" class="form-control" name="old_password" required>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="form-label">Nouveau mot de passe</label>
                                    <input type="password" class="form-control" name="new_password" required>
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="form-label">Confirmer</label>
                                    <input type="password" class="form-control" name="confirm_password" required>
                                </div>
                                <button type="submit" name="btn_update_password" class="btn btn-primary rounded-pill px-4">Mettre à jour</button>
                            </form>
                        </div>
                    </div>

                <?php elseif ($page_actuelle == 'email'): ?>
                    <h2 class="mb-4 text-center">Changer d'e-mail</h2>
                    <div class="card">
                        <div class="card-body p-4">
                            <p class="text-center text-muted mb-4">Actuel : <strong class="text-white"><?= htmlspecialchars($currentUser['mailU']) ?></strong></p>
                            <form method="POST" action="?page=email">
                                <div class="mb-3">
                                    <label class="form-label">Nouvelle adresse e-mail</label>
                                    <input type="email" class="form-control" name="new_email" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Mot de passe actuel</label>
                                    <input type="password" class="form-control" name="verif_password" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="btn_update_email" class="btn btn-primary rounded-pill px-5">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php elseif ($page_actuelle == 'notifications'): ?>
                    <h2 class="mb-4 text-center">Préférences</h2>
                    <form method="POST" action="?page=notifications">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-secondary">
                                    <span class="fw-bold">Notifications globales</span>
                                    <label class="ios-switch">
                                        <input type="checkbox" name="notif_global" checked>
                                        <span class="ios-slider"></span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-3">
                                    <span>Mode sombre</span>
                                    <label class="ios-switch">
                                        <input type="checkbox" name="dark_mode" checked>
                                        <span class="ios-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary rounded-pill px-5">Enregistrer</button>
                        </div>
                    </form>

                <?php endif; ?>
                </div>
        </main>

    </div>

    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="list-group list-group-flush">
                <a href="?page=infos" class="list-group-item list-group-item-action bg-transparent text-white border-0">Informations</a>
                <a href="?page=notifications" class="list-group-item list-group-item-action bg-transparent text-white border-0">Notifications</a>
                <a href="?page=email" class="list-group-item list-group-item-action bg-transparent text-white border-0">E-mail</a>
                <a href="?page=mot2passe" class="list-group-item list-group-item-action bg-transparent text-white border-0">Mot de passe</a>
            </div>
        </div>
    </div>

    <?php include './../main/footer.php'; ?>
    <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
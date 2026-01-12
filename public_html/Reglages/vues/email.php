<?php
// TRAITEMENT SPECIFIQUE EMAIL
$msg_success = null;
$msg_error = null;

if (isset($_POST['btn_update_email'])) {
    $new_email = filter_var($_POST['new_email'], FILTER_SANITIZE_EMAIL);
    $verif_pwd = $_POST['verif_password'];

    if (password_verify($verif_pwd, $currentUser['mdpU'])) {
        try {
            $update = $pdo->prepare("UPDATE Utilisateurs SET mailU = ? WHERE idU = ?");
            $update->execute([$new_email, $idUser]);
            $_SESSION['mailU'] = $new_email;
            $currentUser['mailU'] = $new_email;
            $msg_success = "Adresse e-mail mise à jour.";
        } catch (PDOException $e) {
            $msg_error = "Cet email est peut-être déjà utilisé.";
        }
    } else {
        $msg_error = "Mot de passe incorrect.";
    }
}
?>

<h2 class="mb-4 text-cente">Changer d'e-mail</h2>

<?php if ($msg_error): ?><div class="alert alert-danger mb-4"><?= $msg_error ?></div><?php endif; ?>
<?php if ($msg_success): ?><div class="alert alert-success mb-4"><?= $msg_success ?></div><?php endif; ?>

<div class="card">
    <div class="card-body p-4">
        
        <p class="text-center mb-4" style="color: black;">
            Actuel : <strong><?= htmlspecialchars($currentUser['mailU']) ?></strong>
        </p>

        <form method="POST" action="?page=email">
            <div class="mb-3">
                <label class="form-label" style="color: black;">Nouvelle adresse e-mail</label>
                <input type="email" class="form-control" name="new_email" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label" style="color: black;">Mot de passe actuel</label>
                <input type="password" class="form-control" name="verif_password" required>
            </div>
            
            <div class="text-center">
                <button type="submit" name="btn_update_email" class="btn btn-primary rounded-pill px-5">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
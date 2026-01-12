<?php

$msg_success = null;
$msg_error = null;

if (isset($_POST['btn_update_password'])) {
    $old_pwd = $_POST['old_password'];
    $new_pwd = $_POST['new_password'];
    $conf_pwd = $_POST['confirm_password'];


    if (password_verify($old_pwd, $currentUser['mdpU'])) {
        if ($new_pwd === $conf_pwd) {
            $new_hash = password_hash($new_pwd, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE Utilisateurs SET mdpU = ? WHERE idU = ?");
            $update->execute([$new_hash, $idUser]);
            $msg_success = "Mot de passe modifié.";
            $currentUser['mdpU'] = $new_hash; 
        } else {
            $msg_error = "Les nouveaux mots de passe ne correspondent pas.";
        }
    } else {
        $msg_error = "L'ancien mot de passe est incorrect.";
    }
}
?>

<h2 class="mb-4 text-center">Sécurité</h2>

<?php if ($msg_error): ?><div class="alert alert-danger mb-4"><?= $msg_error ?></div><?php endif; ?>
<?php if ($msg_success): ?><div class="alert alert-success mb-4"><?= $msg_success ?></div><?php endif; ?>

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
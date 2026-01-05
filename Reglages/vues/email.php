<form method ="" action="">
    <div class="card border-0 rounded-4 p-5 shadow" style="background-color: #2c2f33;">

        <h3 class="text-white text-center mb-4">Changer d'adresse e-mail</h3>

        <?php
        if (isset($msg_error)) {
            echo '<div class="alert alert-danger">' . $msg_error . '</div>';
        }
        ?>
        <?php
        if (isset($msg_success)) {
            echo '<div class="alert alert-success">' . $msg_success . '</div>';
        }
        ?>

        <div class="mb-3 text-start">
            <label for="new_email" class="form-label text-white fw-bold">Nouvelle adresse e-mail</label>
            <input type="email" class="form-control" id="new_email" name="new_email" 
                   placeholder="exemple@isanet.fr" required>
        </div>

        <div class="mb-4 text-start">
            <label for="verif_password" class="form-label text-white fw-bold">Mot de passe actuel</label>
            <input type="password" class="form-control" id="verif_password" name="verif_password" 
                   placeholder="Confirmez votre mot de passe" required>
            <div class="form-text text-secondary">
                Pour des raisons de sécurité, veuillez saisir votre mot de passe actuel.
            </div>
        </div>

        <div class="text-center">
            <button type="submit" name="btn_update_email" class="btn btn-primary rounded-pill px-5 py-2 fw-bold text-uppercase">
                Enregistrer
            </button>
        </div>

        <p class="text-secondary mt-4 mb-0 text-center">
            Vous rencontrez des difficultés ?
            <a href="https://www.instagram.com/sime.i2s/" target="_blank" class="text-decoration-none" style="color: #9900ff;">
                Contacter @sime.i2s
            </a>.
        </p>

    </div>
</form>

<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>;

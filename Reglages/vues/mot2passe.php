<section class="settings-content d-flex flex-column justify-content-center align-items-center flex-grow-1 py-5">
    <div class="w-75">
        <h2 class="text-center mb-4">Paramètres du Compte</h2>

        <form method="POST" action="">

            <?php
            if (isset($msg_error)) {
                echo '<div class="alert alert-danger">' . $msg_error . '</div>';
            }
            if (isset($msg_success)) {
                echo '<div class="alert alert-success">' . $msg_success . '</div>';
            }
            ?>

            <div class="settings-box text-center p-4 rounded shadow" style="background-color: #2c2f33;">
                
                <h3 class="text-white mb-3">Changer le mot de passe</h3>
                
                <p class="text-secondary mb-4">
                    Pour votre sécurité, choisissez un mot de passe fort.<br>
                    <small class="text-warning">
                        <i class="bi bi-exclamation-triangle"></i> En changeant votre mot de passe, vous serez déconnecté.
                    </small>
                </p>

                <div class="mb-3 text-start">
                    <label for="old_password" class="form-label text-white fw-semibold">Ancien mot de passe</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Votre mot de passe actuel" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="new_password" class="form-label text-white fw-semibold">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nouveau mot de passe" required>
                </div>

                <div class="mb-4 text-start">
                    <label for="confirm_password" class="form-label text-white fw-semibold">Confirmer le nouveau mot de passe</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Répétez le mot de passe" required>
                </div>

                <button type="submit" name="btn_update_password" class="btn btn-primary fw-bold px-4 py-2 text-uppercase rounded-pill">
                    Mettre à jour le mot de passe
                </button>

                <p class="text-secondary mt-4 mb-0">
                    Vous rencontrez des difficultés ?
                    <a href="https://www.instagram.com/sime.i2s/" target="_blank" class="text-decoration-none" style="color: #9900ff;">
                        Contacter @sime.i2s
                    </a>.
                </p>
            </div>

        </form>
    </div>
</section>

<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>;

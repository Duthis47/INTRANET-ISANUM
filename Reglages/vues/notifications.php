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

            <div class="list-group bg-dark rounded shadow p-3">

                <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary">
                    <span class="text-white">Notifications</span>
                    <label class="ios-switch">
                        <input type="checkbox" name="notif_global" checked>
                        <span class="ios-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary">
                    <span class="text-white">Recevoir les e-mails</span>
                    <label class="ios-switch">
                        <input type="checkbox" name="notif_email">
                        <span class="ios-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary">
                    <span class="text-white">Sous-titres automatiques</span>
                    <label class="ios-switch">
                        <input type="checkbox" name="auto_subs" checked>
                        <span class="ios-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary">
                    <span class="text-white">Mode sombre</span>
                    <label class="ios-switch">
                        <input type="checkbox" name="dark_mode" checked>
                        <span class="ios-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3">
                    <span class="text-white">Lecture automatique</span>
                    <label class="ios-switch">
                        <input type="checkbox" name="auto_play">
                        <span class="ios-slider"></span>
                    </label>
                </div>

            </div>

            <div class="text-center mt-4">
                <button type="submit" name="btn_update_notifs" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold">
                    Enregistrer les préférences
                </button>
            </div>

        </form>
    </div>
</section>
<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

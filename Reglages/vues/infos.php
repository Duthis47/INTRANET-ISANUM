
<section class="settings-content d-flex flex-column justify-content-center align-items-center flex-grow-1 py-5">
    <div class="w-75">
        <h2 class="text-center mb-4">Paramètres du Compte</h2>

        <form method="POST" action="">

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

            <div class="card shadow-sm border-0 rounded-4 mb-4" style="background-color: #2c2f33;">
                <div class="card-body">
                    <label for="nom" class="form-label fw-semibold text-secondary">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" 
                           value="<?php echo isset($user['nom']) ? $user['nom'] : $_SESSION['nomU']; ?>" required>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mb-4" style="background-color: #2c2f33;">
                <div class="card-body">
                    <label for="prenom" class="form-label fw-semibold text-secondary">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" 
                           value="<?php echo isset($user['prenom']) ? $user['prenom'] : $_SESSION['prenomU']; ?>" required>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mb-4" style="background-color: #2c2f33;">
    <div class="card-body">
        <label for="year" class="form-label fw-semibold text-secondary">Année de formation</label>
        <select class="form-select" id="year" name="year">
            
            <option value="1" <?php echo (isset($_SESSION['idF']) && $_SESSION['idF'] == 1) ? 'selected' : ''; ?>>
                ISA NUM 1
            </option>

            <option value="2" <?php echo (isset($_SESSION['idF']) && $_SESSION['idF'] == 2) ? 'selected' : ''; ?>>
                ISA NUM 2
            </option>

            <option value="3" <?php echo (isset($_SESSION['idF']) && $_SESSION['idF'] == 3) ? 'selected' : ''; ?>>
                ISA NUM 3
            </option>

            <option value="4" <?php echo (isset($_SESSION['idF']) && $_SESSION['idF'] == 4) ? 'selected' : ''; ?>>
                ISA NUM 4
            </option>

            <option value="5" <?php echo (isset($_SESSION['idF']) && $_SESSION['idF'] == 5) ? 'selected' : ''; ?>>
                ISA NUM 5
            </option>

        </select>
    </div>
</div>

            <div class="text-center">
                <button type="submit" name="btn_update_infos" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold">
                    Enregistrer les modifications
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

<?php

$msg_success = null;
$msg_error = null;

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
        $currentUser['nomU'] = $nom; 
        $currentUser['prenomU'] = $prenom;
        $currentUser['idF'] = $idF;
        
        $msg_success = "Informations mises à jour.";
    } catch (PDOException $e) {
        $msg_error = "Erreur SQL : " . $e->getMessage();
    }
}
?>

<h2 class="mb-4 text-center">Mes Informations</h2>

<?php if ($msg_error): ?>
    <div class="alert alert-danger mb-4"><?= $msg_error ?></div>
<?php endif; ?>
<?php if ($msg_success): ?>
    <div class="alert alert-success mb-4"><?= $msg_success ?></div>
<?php endif; ?>

<form method="POST" action="?page=infos">
    
    <div class="card mb-3">
        <div class="card-body">
            <label for="nom" class="form-label" style="color: black ;">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" 
                   value="<?php echo htmlspecialchars($currentUser['nomU']); ?>" required>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <label for="prenom" class="form-label" style="color: black;">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" 
                   value="<?php echo htmlspecialchars($currentUser['prenomU']); ?>" required>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <label for="year" class="form-label" style="color: black;">Année de formation</label>
            <select class="form-select" id="year" name="year">
                <?php 
                $currentIdF = isset($currentUser['idF']) ? $currentUser['idF'] : 1;
                for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= ($currentIdF == $i) ? 'selected' : '' ?>>
                        ISA NUM <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" name="btn_update_infos" class="btn btn-primary rounded-pill px-5">
            Confirmer
        </button>
    </div>

</form>
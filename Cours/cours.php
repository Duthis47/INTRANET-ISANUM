<?php
session_start();
include_once ('./../Connexion/laConnexion.php');
if (!isset($_SESSION['idU'])) {
    header("Location:http://10.3.17.220/SAE/Authentification/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ISA NET - Cours</title>



        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./../Style/css/style.css" rel="stylesheet">



    </head>

    <body>


        <?php
        include './../main/header.php';
        ?>



        <div class="container px-4 py-5" id="custom-cards">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <form method="GET" action="">
                    <select class="form-select form-select-lg title-select fw-semibold text-center" 
                            id="anneeFormation" name="anneeFormation" required onchange="this.form.submit()">
                        <option value="">Année de formation</option>

                        <?php
                        $ordreSQL = "SELECT * FROM Formation";
                        $RequetePrep = $pdo->prepare($ordreSQL);
                        $RequetePrep->execute();

                        while ($AnneeFormation = $RequetePrep->fetch()) {
                            $selected = (isset($_GET['anneeFormation']) && $_GET['anneeFormation'] == $AnneeFormation['idF']) ? 'selected' : '';
                            
                            echo "<option value=\"{$AnneeFormation['idF']}\" {$selected}>{$AnneeFormation['nomF']}</option>";   
                                echo $AnneeFormation['nomF']; 
                            echo "</option>";
                        }
                        ?>
                    </select>
                    </form>
                </div>
            </div>


            <br>
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">

                <?php
                if (!empty($_GET['anneeFormation'])) {
                    $ordreSQL = "SELECT * FROM Matiere WHERE idF = :idF";
                    $RequeteP = $pdo->prepare($ordreSQL);
                    $RequeteP->bindParam(':idF', $_GET['anneeFormation'], PDO::PARAM_INT);
                } else {
                    $ordreSQL = "SELECT * FROM Matiere";
                    $RequeteP = $pdo->prepare($ordreSQL);
                }
                $RequeteP->execute();
                $lesMatieres = $RequeteP->fetchall();
                foreach ($lesMatieres as $Matiere) {
                    ?>

                    <!--1er Matière -->
                    <div class="col">
                        <a href="./matieres.php?Matiere=<?php echo $Matiere['idM']; ?>&Formation=<?php echo $Matiere['idF'] ?>" class="text-decoration-none">
                            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                                 style="background-image: url(./../img/matieres/<?php echo $Matiere["nomImg"]; ?>)">
                                <div class="d-flex flex-column  p-5 pb-3 text-white text-shadow-1">
                                    <h3 class="display-6 lh-1 fw-bold matiere-title text-center">
                                        <?php echo $Matiere['nomM'] ?>
                                    </h3>
                                    <ul class="d-flex list-unstyled mt-auto">
                                        <li class="me-auto">
                                            <img src="./../img/annee/<?php echo $Matiere["idF"]; ?>.jpg" alt="classe année" width="32" height="32"
                                                 class="rounded-circle border border-white" />
                                        </li>

                                        <li class="d-flex align-items-center">
                                            <small style="color: black;">+99</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php
                }
                ?>




            </div>
        </div>

        <a href="http://10.3.17.220/SAE/Cours/ajoutDoc.php"
           class="btn btn-primary btn-floating btn-add-course">
            <i class="bi bi-plus-lg me-2"></i>
            Ajouter un cours
        </a>

        <?php
        include './../main/footer.php';
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../assets/js/color-modes.js"></script>
</body>

</html>


<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

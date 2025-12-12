<?php
session_start();
require_once 'laConnexion.php';
if (!isset($_SESSION['idU'])) {
    header("Location:http://localhost/SAE/Authentification/login.php");
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
        <link href="./../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./../Style/css/style.css" rel="stylesheet">



    </head>

    <body>


        <?php
        include './../main/header.php';
        ?>



        <div class="container px-4 py-5" id="custom-cards">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <select class="form-select form-select-lg title-select fw-semibold text-center" id="anneeFormation" required>
                        <option value="">Année de formation</option>
                        <?php
                        $ordreSQL = "SELECT * FROM Formation";
                        $RequetePrep = $Connexion->prepare($ordreSQL);
                        $RequetePrep->execute();
                        $lesAnneesFormations = ; 
                                foreach ($array as $value) {
                                    ?>
                                    <option>ISA NUM 1</option>
                                    <?php
                                }
                        ?>
                        
                        <option>ISA NUM 1</option>
                        <option>ISA NUM 2</option>
                        <option>ISA NUM 3</option>
                        <option>ISA NUM 4</option>
                        <option>ISA NUM 5</option>
                    </select>
                </div>
            </div>


            <br>

            <h2 class="pb-2 border-bottom">ISA NUM 1</h2>
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">

                <!--1er Matière -->
                <div class="col">
                    <a href="#">
                        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                             style="background-image: url(./../img/matieres/maths.jpg)">
                            <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
                                    Nom Mat1
                                </h3>
                                <ul class="d-flex list-unstyled mt-auto">
                                    <li class="me-auto">
                                        <img src="./../img/annee/1.jpg" alt="classe année" width="32" height="32"
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

                <!-- 2e Matière -->
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                         style="background-image: url(./../img/matieres/maths1\ .jpg)">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold" style="color: black;">
                                NomMat2
                            </h3>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <img src="./../img/annee/2.jpg" alt="Bootstrap" width="32" height="32"
                                         class="rounded-circle border border-white" />
                                </li>
                                <li class="d-flex align-items-center">

                                    <small>90</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                
                

            </div>
        </div>

        <a href="http://localhost/SAE/Cours/ajouterCours.php" class="btn btn-primary btn-floating" id="btn-fixed-cours">
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
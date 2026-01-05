<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>ISA NET - Cours</title>

        <!-- Début des imports Boostraps-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <script src="./../assets/js/color-modes.js"></script>
        <script src="./../assets/dist/js/bootstrap.bundle.min.js"></script>
        <link href="./../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./../Style/navbars-offcanvas.css" rel="stylesheet" />
        <link href="./../Style/css/style.css" rel="stylesheet" />


        <!--Fin des imprts bootstraps-->

    </head>

    <body>
        
        <?php
            include './../main/header.php';
        ?>

        <main class="container">
            <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">


                <h1 class="display-4 fw-medium text-center mb-5">
                    <strong>ISA NUM 1 - Matière</strong>
                </h1>


                <div class="row">


                    <div class="col-lg-6 px-4">
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <!--
                            <a href="ressource.php?id=<?= $ressource['id'] ?>" class="text-decoration-none flex-grow-1">-->
                                <span class="lead mb-0 d-block">
                                    NomChapitre - n°TD - nomTD
                                </span>
                            </a>

                           
                            <form action="supprimer_ressource.php" method="POST" class="mb-0">
                                <input type="hidden" name="id" value="<?= $ressource['id'] ?>">
                                <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                        title="Supprimer cette ressource">
                                    <i class="bi bi-x-lg fs-5"></i>
                                </button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <a href="ressource.php?id=<?= $ressource['id'] ?>" class="text-decoration-none flex-grow-1">
                                <span class="lead mb-0 d-block">
                                    NomChapitre - n°TD - nomTD
                                </span>
                            </a>

                            <form action="supprimer_ressource.php" method="POST" class="mb-0">
                                <input type="hidden" name="id" value="<?= $ressource['id'] ?>">
                                <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                        title="Supprimer cette ressource">
                                    <i class="bi bi-x-lg fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>


                    <div class="col-lg-6 px-4">
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <a href="ressource.php?id=<?= $ressource['id'] ?>" class="text-decoration-none flex-grow-1">
                                <span class="lead mb-0 d-block">
                                    NomChapitre - n°TD - nomTD
                                </span>
                            </a>

                            <form action="supprimer_ressource.php" method="POST" class="mb-0">
                                <input type="hidden" name="id" value="<?= $ressource['id'] ?>">
                                <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                        title="Supprimer cette ressource">
                                    <i class="bi bi-x-lg fs-5"></i>
                                </button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <a href="ressource.php?id=<?= $ressource['id'] ?>" class="text-decoration-none flex-grow-1">
                                <span class="lead mb-0 d-block">
                                    NomChapitre - n°TD - nomTD
                                </span>
                            </a>

                            <form action="supprimer_ressource.php" method="POST" class="mb-0">
                                <input type="hidden" name="id" value="<?= $ressource['id'] ?>">
                                <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                        title="Supprimer cette ressource">
                                    <i class="bi bi-x-lg fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <?php 
            include './../main/footer.php';
        ?>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
</body>

</html>


<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
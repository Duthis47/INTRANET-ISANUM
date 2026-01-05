<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISA NET - Forum</title>



    <!-- Début des imports Boostraps-->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href="./../assets/dist/css/bootstrap.min.css" rel="stylesheet" />



    <link href="./../Style/css/style.css" rel="stylesheet" />

    <!--Fin des imprts bootstraps-->

</head>


<body>

    <?php 
        include './../main/header.php';
    ?>


    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">

            <h1 class="display-5 fw-semibold text-center mb-4">
                Les questions
            </h1>

            <!-- Barre de recherche -->
            <form class="d-flex justify-content-center mb-4" role="search" onsubmit="return false;">
                <div class="input-group input-group-forum" style="max-width: 400px;">
                    <span class="input-group-text input-group-text-forum bg-light">
                        <i class="bi bi-search"></i>
                    </span>
                    <input id="searchInput" class="form-control" type="search" placeholder="Rechercher une question..."
                        aria-label="Search">
                </div>
            </form>

            <!-- Liste des questions -->
            <div id="questionList" class="row">
                <div class="col-lg-6 px-4">

                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <a href="#" class="text-decoration-none flex-grow-1">
                            <p class="lead mb-0 d-block">
                                Question numéro 1 : comment fait-elle pour être aussi longue ?
                            </p>
                        </a>

                        <!---
                        <form action="#" method="POST" class="mb-0">
                            <input type="hidden" name="id" value="<? $ressource['id'] ?>">
                            <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                title="Supprimer cette ressource">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                        </form>
                    -->
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <a href="ressource.php?id=<?= $ressource['id'] ?>" class="text-decoration-none flex-grow-1">
                            <p class="lead mb-0 d-block">
                                Chapitre 1 - TD2 - Structures de données
                            </p>
                        </a>

                        <!--
                        <form action="supprimer_ressource.php" method="POST" class="mb-0">
                            <input type="hidden" name="id" value="<?= $ressource['id'] ?>">
                            <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                title="Supprimer cette ressource">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                        </form>-->
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <a href="ressource.php?id=<?= $ressource['id'] ?>" class="text-decoration-none flex-grow-1">
                            <p class="lead mb-0 d-block">
                                Chapitre 2 - TD3 - Introduction au Java
                            </p>
                        </a>

                        <!---
                        <form action="supprimer_ressource.php" method="POST" class="mb-0">
                            <input type="hidden" name="id" value="< $ressource['id'] ?>">
                            <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                title="Supprimer cette ressource">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                        </form>-->
                    </div>
                </div>
                <div class="col-lg-6 px-4">

                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <a href="#" class="text-decoration-none flex-grow-1">
                            <p class="lead mb-0 d-block">
                                Chapitre 3 - TD1 - Programmation orientée objet
                            </p>
                        </a>

                        <!---
                        <form action="#" method="POST" class="mb-0">
                            <input type="hidden" name="id" value="<? $ressource['id'] ?>">
                            <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                title="Supprimer cette ressource">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                        </form>-->
                    </div>
                    <!---<div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <a href="ressource.php?id=<? $ressource['id'] ?>" class="text-decoration-none flex-grow-1">-->
                            <p class="lead mb-0 d-block">
                                Chapitre 4 - TD5 - Bases de données SQL< </p>
                        </a>

                        <!---
                        <form action="supprimer_ressource.php" method="POST" class="mb-0">
                            <input type="hidden" name="id" value="<? $ressource['id'] ?>">
                            <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                title="Supprimer cette ressource">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                        </form>-->
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <a href="#" class="text-decoration-none flex-grow-1">
                            <p class="lead mb-0 d-block">
                                Chapitre 5 - TD2 - Systèmes d’exploitation
                            </p>
                        </a>

                        <!---
                        <form action="#" method="POST" class="mb-0">
                            <input type="hidden" name="id" value="<? $ressource['id'] ?>">
                            <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center"
                                title="Supprimer cette ressource">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                        </form>-->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php 
    include './../main/footer.php';
    ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>
    <script src="./../Accueil.js"></script>
    <script src="./searchB.js"></script>

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

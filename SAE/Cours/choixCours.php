<!doctype html>
<html lang="fr" data-bs-theme="auto">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1" />
        <meta name="description" content="" />
        <title>ISA NET - New cours</title>
        <!--Nav Bar-->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <script src="./../assets/js/color-modes.js"></script>
        <script src="./../assets/dist/js/bootstrap.bundle.min.js"></script>
        <link href="./../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./../Style/css/style.css" rel="stylesheet" />

        <!--Fin import Nav Bar-->
    </head>

    <body>

        <?php
            include './../main/header.php';
        ?>

        <div class="container">
            <main>
                <div class="py-5 text-center">
                    <img class="d-block mx-auto mb-4" src="./../img/quest.png" alt="" width="100" height="80" />
                    <h1 class="h2">Super ! Un nouveau cours </h1>
                    <p class="lead">
                        Cette rubrique permet d'ajouter une question à la partie Forum.Cette rubrique répond à des questions qui
                        peuvent être redondantes et/ ou répétitives.
                        L'objectif est que vous ayez l'ensemble des questions que vous verrez au cours de vos études en 1 endroits...
                        (à reformuler).
                    </p>
                </div>
                <div class="row g-5">

                </div>
                <div class="col-md-7 col-lg-8">
                    <br>
                    <h4 class="mb-3">INFORMATIONS</h4>
                    <form class="needs-validation" action="#" method="#" novalidate>
                        <div class="row g-3">

                            <div class="col-md-7">
                                <label for="country" class="form-label">Année de Formation</label>
                                <select class="form-select" id="country" required>
                                    <option value="">choisir l'année...</option>
                                    <option>ISA NUM 1</option>
                                    <option>ISA NUM 2</option>
                                    <option>ISA NUM 3</option>
                                    <option>ISA NUM 4</option>
                                    <option>ISA NUM 5</option>

                                </select>
                                <div class="invalid-feedback">
                                    Sélectionnez l'année correspondante !
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="col-md-7">
                                <label for="country" class="form-label">Sélection de la </label>
                                <select class="form-select" id="country" required>
                                    <option value="">Matière</option>
                                    <option>Maths</option>
                                    <option>Stats</option>
                                    <option>POO</option>
                                    <option>Électronique</option>
                                    <option>WEB</option>
                                    <option>Réseaux</option>
                                    <option>Communication</option>
                                </select>

                                <div class="invalid-feedback">
                                    Sélectionnez une matière !
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="col-md-7">
                                <label for="country" class="form-label">Sélection de la </label>
                                <select class="form-select" id="country" required>
                                    <option value="">Matière</option>
                                    <option>CC</option>
                                    <option>CC Blanc</option>
                                    <option>TD</option>
                                    <option>TP</option>
                                    <option>Cours</option>
                                    <option>Autres</option>
                                </select>

                                <div class="invalid-feedback">
                                    Sélectionnez une matière !
                                </div>
                            </div>


                            <hr class="my-4" />

                            <div class="col-sm-8">
                                <label for="firstName" class="form-label">Nom du Document</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required />

                                <div class="invalid-feedback">
                                    Ce nom n'est pas valide !
                                </div>
                            </div>


                            <hr class="my-4" />
                            <div class="col-sm-10">
                                <label for="firstName" class="form-label">Description</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required />


                                <div class="invalid-feedback">
                                    Cette description n'est pas valide !
                                </div>
                            </div>

                            <div class="col-sm-10">


                                <hr class="my-4" />
                                <div class="mb-3">
                                    <label class="form-label" for="customFile">Téléverser le fichier</label>
                                    <input type="file" class="form-control" id="customFile" required />
                                </div>

                                <div class="invalid-feedback">
                                    Ce fichier n'est pas un PDF
                                </div>

                            </div>


                            <hr class="my-4" />
                            <button class="w-100 btn btn-primary btn-lg" type="submit">
                                Continue to checkout
                            </button>
                    </form>
                </div>
        </div>


    </main>


    <br>
    <br>

    <?php 
        include './../main/footer.php';
    ?>

</div>

<script src="./checkout.js" class="astro-vvvwv3sm"></script>
</body>

</html>

<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
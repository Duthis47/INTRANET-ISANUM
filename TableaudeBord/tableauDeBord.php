<!doctype html>
<html lang="fr" >

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <title>ISA NET - Tableau de bord</title>
        

        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
        <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
        <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./../Style/css/style.css" rel="stylesheet" />

        

    </head>

    
    <?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require '../Connexion/laConnexion.php'; 
    require '../Connexion/noSQLConnexion.php';

    if (!isset($_SESSION['idU'])) {
    header("Location: http://10.3.17.220/SAE/Authentification/login.php");
    exit();
    }
    ?>

    <body>

        <?php 
        include './../main/header.php';
        ?>

        <main class="container">
            <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
                <div class="col-lg-6 px-0">
                    <h1 class="display-4 fst-italic">
                        Tableau de bord
                    </h1>
                    <p class="lead my-3">
                        Ici retrouvez l'intégralité de vos informations.
                        Utilisez ces informations afin de booster votre productivité.
                    </p>

                </div>
            </div>
            <div class="row mb-2">


                <!--Assistant IA-->
                <div class="col-md-7">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative gradende-bleu ">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 color-bleu-system">Assistant IA</strong>

                            <div class="mb-1 ">Récap.</div>
                            <br>
                            <p class="card-text mb-auto">
                                This is a wider card with supporting text below as a natural
                                lead-in to additional content.
                            </p>

                        </div>

                    </div>
                </div>

                <!--Messages non lus-->
                <div class="col-md-5">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="color-bleu-system">Mes messages</strong>
                                <!--<i class="bi bi-envelope-fill fs-4 text-primary bg-light rounded-circle p-2"></i>-->
                                <i class="bi bi-eye fs-4 text-primary rounded-circle"></i>
                            </div>

                            <div class="mb-1 ">Nouveaux messages</div>
                            <p class="mb-auto">
                                <br>
                                Vous avez reçu<strong> 1 Nouveaux </strong> message(s) non lu(s)
                            </p>
                            <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                                Voir plus  
                                <svg class="bi" aria-hidden="true">
                                <use xlink:href="#chevron-right"></use>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>



                <!--Derniers cours-->
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 color-bleu-system">Mes derniers cours</strong>
                            <br>
                            <p class="card-text mb-auto">
                                Maths - TD - Intitulé
                            </p>
                            <br>
                            <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                                Voir les autres cours

                            </a>
                        </div>
                        <div class="col-auto d-none d-lg-block">

                        </div>
                    </div>
                </div>

                <!--Evenemnts-->
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative gradende-bleu">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 color-bleu-system">Évènements</strong>
                            <h3 class="mb-0">Soirée chez X</h3>
                            <br>
                            <p class="mb-auto">
                                Ici, il y aura la description choisi par la personne
                            </p>
                            <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                                Voir les évènements
                                <svg class="bi" aria-hidden="true">
                                <use xlink:href="#chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <div style="width:200px; height:250px; overflow:hidden; border-radius:0 .375rem .375rem 0;">
                                <img src="./../img/img.jpg.avif" alt="Soirée chez X"
                                     style="width:100%; height:100%; object-fit:cover; object-position:center;">
                            </div>
                        </div>
                    </div>
                </div>

        </main>
        
        <?php
            include './../main/footer.php';
        ?>

    </body>
</html>

<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

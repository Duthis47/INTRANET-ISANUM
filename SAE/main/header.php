<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

?>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar">
                <div class="container-fluid">


                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="./../img/logoISANET.png" alt="Logo ISA NET" class="img-fluid rounded me-2"
                             style="height:40px; object-fit:cover;">
                    </a>


                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar"
                         aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>


                        <div class="offcanvas-body d-flex flex-lg-row flex-column align-items-lg-center ">

                            <ul class="navbar-nav text-center mb-3 mb-lg-0 mx-lg-auto align-items-lg-center">
                                <li class="nav-item px-lg-3"><a class="nav-link active" href="#">Accueil</a></li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="#">Tableau de bord</a></li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="#">Cours</a></li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="#">Forum</a></li>

                                <li class="nav-item dropdown px-lg-3">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">À propos</a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="#">ISA NUM</a></li>
                                        <li><a class="dropdown-item" href="#">Règlements d'étude</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">SimePrime</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item px-lg-3"><a class="nav-link" href="#">Message</a></li>
                            </ul>


                            <div class="nav-item dropdown ms-lg-auto mt-2 mt-lg-0 text-center">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarProfil" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    Username
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-center" aria-labelledby="navbarProfil">
                                    <li><a class="dropdown-item" href="#">Mon Compte</a></li>
                                    <li><a class="dropdown-item" href="#">Se Déconnecter</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>
        </header>
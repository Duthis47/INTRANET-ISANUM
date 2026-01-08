        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar">
                <div class="container-fluid">


                    <a class="navbar-brand d-flex align-items-center" href="http://10.3.17.220/SAE/Accueil.php">
                        <img src="http://10.3.17.220/SAE/img/logoISANET.png" alt="Logo ISA NET" class="img-fluid rounded me-2"
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
                                <li class="nav-item px-lg-3"><a class="nav-link active" href="http://10.3.17.220/SAE/Accueil.php">Accueil</a></li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="http://10.3.17.220/SAE/TableaudeBord/tableauDeBord.php">Tableau de bord</a></li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="http://10.3.17.220/SAE/Cours/cours.php">Cours</a></li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="http://10.3.17.220/SAE/Forum/questionsForum.php">Forum</a></li>

                                <li class="nav-item dropdown px-lg-3">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">À propos</a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="https://isanum.univ-pau.fr/fr/actualites.html">ISA NUM</a></li>
                                        <li><a class="dropdown-item" href="https://isanum.univ-pau.fr/fr/ecole-et-formation/reglement-des-etudes-et-scolarite.html">Règlements d'étude</a></li>
                                        <li><a class="dropdown-item" href="https://isanum.univ-pau.fr/fr/relations-entreprises.html">Partenaires</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="http://10.3.17.220/SAE/Evenements/Evenements.php">Evenements</a></li>
                                <li class="nav-item px-lg-3"><a class="nav-link" href="http://10.3.17.220/SAE/Message/Message.php">Message</a></li>
                            </ul>


                            <div class="nav-item dropdown ms-lg-auto mt-2 mt-lg-0 text-center">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarProfil" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo htmlspecialchars($_SESSION['prenomU'] ?? 'Identifiant') ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-center" aria-labelledby="navbarProfil">
                                    <li><a class="dropdown-item" href="http://10.3.17.220/SAE/Reglages/parametres.php?page=infos">Mon Compte</a></li>
                                    <?php
                                    if (isset($_SESSION['idU'])){ ?>
                                        <li><a class="dropdown-item" href="http://10.3.17.220/SAE/Connexion/deconnexion.php">Se Déconnecter</a></li>
                                    <?php } else { ?>
                                        <li><a class="dropdown-item" href="http://10.3.17.220/SAE/Connexion/connexion.php">Se Connecter</a></li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>
        </header>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ISA NET - Accueil</title>

  <link rel="stylesheet" href="./Style/css/Accueil.css">

  <!-- Début des imports Boostraps-->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <script src="./Style/Bootstrap/assets/js/color-modes.js"></script>



  <link href="./Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <meta name="theme-color" content="#712cf9" />
  <link href="./Style/navbars-offcanvas.css" rel="stylesheet" />
</head>

<body>

  <?php 
  include './main/header.php';
  ?>


  <section id="speakers" class="banner speakers p-y-3">
    <div class="wrapper">
      <h2 class="m-b-2 display-5 text-uppercase">Notre École ISA NUM</h2>
      <a href="https://isanum.univ-pau.fr/fr/actualites.html" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#speakers_modal">
        Voir le site
      </a>
    </div>
  </section>

  <section>
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <svg aria-hidden="true" class="bd-placeholder-img" height="100%" preserveAspectRatio="xMidYMid slice"
            width="100%" xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
          </svg>
          <div class="container">
            <div class="carousel-caption text-start">
              <h1>Quel exploit </h1>
              <p class="opacity-75">
                LES ISA NUM sont certifiés du CCNA1 & 2 en 6 mois
              </p>
              <p>
                <a class="btn btn-lg btn-primary" href="#">Éditeur</a>
              </p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg aria-hidden="true" class="bd-placeholder-img" height="100%" preserveAspectRatio="xMidYMid slice"
            width="100%" xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
          </svg>
          <div class="container">
            <div class="carousel-caption">
              <h1>3 des ISA NUM</h1>
              <p>
                3 selectionnés pour participer aux évents championnats univ
              </p>
              <p><a class="btn btn-lg btn-primary" href="#">...</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg aria-hidden="true" class="bd-placeholder-img" height="100%" preserveAspectRatio="xMidYMid slice"
            width="100%" xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
          </svg>
          <div class="container">
            <div class="carousel-caption text-end">
              <h1>WEI 2026</h1>
              <p>
                Le WEI est de retour !!!!
              </p>
              <p>
                <a class="btn btn-lg btn-primary" href="#">...</a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>



  <section id="partenaires" class="py-5 bg-dark text-center text-white">
    <div class="container">
      <h2 class="mb-4 text-uppercase fw-bold">Les Partenaires</h2>
      <p class="text-secondary mb-5">Des leaders du numérique qui soutiennent notre école</p>

      <div class="logos-slider position-relative overflow-hidden py-3">
        <div class="logos-track d-flex align-items-center">

          <img src="./img/partenairesISANUM/apple.png" alt="Apple" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/cisco.png" alt="Cisco" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/lanumPB.png" alt="La Numérique PB" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/microsoft.png" alt="Microsoft" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/oracle.png" alt="Oracle" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/PBDigital.png" alt="PB Digital" class="mx-4 logo-img">

          <img src="./img/partenairesISANUM/apple.png" alt="Apple" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/cisco.png" alt="Cisco" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/lanumPB.png" alt="La Numérique PB" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/microsoft.png" alt="Microsoft" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/oracle.png" alt="Oracle" class="mx-4 logo-img">
          <img src="./img/partenairesISANUM/PBDigital.png" alt="PB Digital" class="mx-4 logo-img">
        </div>
      </div>

      <br>

      <div class="mt-4">
        <a href="https://isanum.univ-pau.fr/fr/relations-entreprises.html" class="btn btn-danger btn-lg px-4"
          target="_blank">Découvrir nos partenaires</a>
      </div>
    </div>
  </section>

  <section id="ressources" class="py-5 bg-body text-center">
    <div class="container">
      <h2 class="display-5 fw-bold mb-5 text-uppercase ">Ressources ISA NUM</h2>
      <p class="text-muted mb-5">Accédez aux diff plateformes</p>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card resource-card h-100 shadow-sm border-0">
            <div class="card-img-container">
              <img src="./img/elearn.png" class="card-img-top" alt="E-LEARN">
            </div>
            <div class="card-body">
              <h5 class="card-title fw-bold text-primary">E-LEARN</h5>
              <p class="card-text text-muted">Il faut te normaliser la BDD</p>
              <a href="https://elearn.univ-pau.fr/my/" target="_blank" class="btn btn-outline-primary w-100">
                <i class="bi bi-globe"></i> Consulter
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card resource-card h-100 shadow-sm border-0">
            <div class="card-img-container">
              <img src="./img/partage.png" class="card-img-top" alt="Partage">
            </div>
            <div class="card-body">
              <h5 class="card-title fw-bold text-success">Partage</h5>
              <p class="card-text text-muted">Contact qui tu veux meme des profs qui répondent pas</p>
              <a href="https://partage.univ-pau.fr/" target="_blank" class="btn btn-outline-success w-100">
                <i class="bi bi-send"></i> Mail
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card resource-card h-100 shadow-sm border-0">
            <div class="card-img-container">
              <img src="./img/hyperplanning.jpg" class="card-img-top" alt="HYPERPLANNING">
            </div>
            <div class="card-body">
              <h5 class="card-title fw-bold text-danger">HYPERPLANNING</h5>
              <p class="card-text text-muted">Pas de repos pour les vrais gars... ou pour le CCNA</p>
              <a href="https://univ-pau-planning2025-26.hyperplanning.fr/hp/invite" target="_blank"
                class="btn btn-outline-danger w-100">
                <i class="bi bi-calendar-check-fill"></i> Consulter
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


    <?php 
    include './main/footer.php';
    ?>

  </div>

  <script src="./Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="Accueil.js"></script>
</body>

</html>




<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>ISA NET - Evenements</title>



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  
  <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
  <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>

  <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./../Style/css/carousel.css" rel="stylesheet" />
  <link href="./../Style/css/style.css" rel="stylesheet" />


</head>



<body>

    <?php 
    include("./../main/header.php");
    ?>

  <main>
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





    <!--  ================================================== -->
    <div class="container">

      <hr class="my-4" style="color: white;" />

      <div class="row mb-2 align-items-center justify-content-center">

        <div class="col-md-1">
          <div class="card text-center shadow-sm">
            <div class="card-body p-3">
              <strong class="text-success-emphasis d-block">Lundi</strong>
              <h3 class="mb-0">12</h3>
              <strong class="text-success-emphasis d-block mt-2">Nov</strong>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
            style="background-color: white;">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary-emphasis">THÈME</strong>
              <h3 class="mb-0 alterne-couleur-text">TITRE DE L'EVENT</h3>
              <br>
              <p class="card-text mb-auto alterne-couleur-text">
                Tu dois parler un tas histoire de raconter de qu'est ce qu'il s'agit... Est ce un évèn majeurs ou non
                qui concerne tt le monde ou nn ?
              </p>
              <br>
              <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                (publier par X)
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-1">
          <div class="card text-center shadow-sm d-flex align-items-center justify-content-center"
            style="height: 100%;">
            <form action="#" method="POST" class="mb-0">
              <input type="hidden" name="id" value="<?= $ressource['id'] ?>">
              <button type="submit"
                class="btn btn-link text-danger p-0 d-flex align-items-center justify-content-center"
                title="Supprimer cette ressource">
                <i class="bi bi-x-lg fs-4"></i>
              </button>
            </form>
          </div>
        </div>


        <hr class="my-4" style="color: white;" />




        <div class="col-md-1">
          <div class="card text-center shadow-sm">
            <div class="card-body p-3">
              <strong class="text-success-emphasis d-block">Lundi</strong>
              <h3 class="mb-0">12</h3>
              <strong class="text-success-emphasis d-block mt-2">Nov</strong>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
            style="background-color: white;">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary-emphasis">THÈME</strong>
              <h3 class="mb-0 alterne-couleur-text">TITRE DE L'EVENT</h3>
              <br>
              <p class="card-text mb-auto alterne-couleur-text">
                Tu dois parler un tas histoire de raconter de qu'est ce qu'il s'agit... Est ce un évèn majeurs ou non
                qui concerne tt le monde ou nn ?
              </p>
              <br>
              <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                (publier par X)
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <hr class="my-4" style="color: white;" />


        <div class="col-md-1">
          <div class="card text-center shadow-sm">
            <div class="card-body py-3 px-2 d-flex flex-column align-items-center justify-content-center">
              <strong class="text-success-emphasis">Lun</strong>
              <h3 class="mb-0 fw-bold">12</h3>
              <strong class="text-success-emphasis mt-1">Nov</strong>
            </div>
          </div>
        </div>

        <div class="col-md-auto d-flex align-items-center justify-content-center">
          <div class="card shadow-sm" style="background-color: white; border-radius: 0.5rem;">
            <div class="card-body py-2 px-3 d-flex justify-content-center align-items-center">
              <div style="width: 25px; height: 1.5px; background-color: #6c757d;"></div>
            </div>
          </div>
        </div>

        <div class="col-md-1">
          <div class="card text-center shadow-sm">
            <div class="card-body py-3 px-2 d-flex flex-column align-items-center justify-content-center">
              <strong class="text-success-emphasis">Lun</strong>
              <h3 class="mb-0 fw-bold">12</h3>
              <strong class="text-success-emphasis mt-1">Nov</strong>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
            style="background-color: white;">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary-emphasis">THÈME</strong>
              <h3 class="mb-0 alterne-couleur-text">TITRE DE L'EVENT</h3>
              <br>
              <p class="card-text mb-auto alterne-couleur-text">
                Tu dois parler un tas histoire de raconter de qu'est ce qu'il s'agit... Est ce un évèn majeurs ou non
                qui concerne tt le monde ou nn ?
              </p>
              <br>
              <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                (publier par X)
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <hr class="my-4" style="color: white;" />

      </div>
    </div>

    <!-- FOOTER -->
     <?php 
    include("./../main/footer.php");
    ?>

    </div>


    <script src="./../Accueil.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./../assets/dist/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm"></script>



  </main>
  <script src="./../assets/dist/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm"></script>
</body>

</html>

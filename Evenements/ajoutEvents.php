<?php 
require '../Connexion/laConnexion.php';    

$ordreSQL = "SELECT * FROM Matiere";
$RequeteP = $pdo->prepare($ordreSQL);
$RequeteP->execute();
$lesMatieres = $RequeteP->fetchAll()
?>


<!doctype html>
<html lang="fr" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <title>ISA NET - New Event</title>

  <!--Nav Bar-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  
  <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
  <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
  
  <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="./../Style/css/style.css" rel="stylesheet" />

  <!--Fin import Nav Bar-->


</head>

<body>

  <?php 
    include("./../main/header.php");
    ?>

  <main class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="./../img/quest.png" alt="" width="100" height="80" />
      <h1 class="h2">Ajouter un évènement</h1>
      <p class="lead">
        Cette rubrique permet d'ajouter un évènement si quelque chose se passe
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
            <label for="country" class="form-label">THÈMES</label>
            <select class="form-select" id="country" required>
              <?php 
              foreach($lesMatieres as $laMatiere){
                ?>
                <option value=""><?php echo $laMatiere['nomM'] ?></option>
                <?php
              }
              ?>
            </select>

            <div class="invalid-feedback">
              Sélectionnez une matière !
            </div>
          </div>

          <hr class="my-4">

          <div class="my-3">
            <h4 class="mb-3">Durée</h4>
            <div class="form-check">
              <input id="CC" name="tmpsEvent" type="radio" class="form-check-input" required />
              <label class="form-check-label" for="credit">sur un jour</label>
            </div>
            <div class="form-check">
              <input id="CCB" name="tmpsEvent" type="radio" class="form-check-input" required />
              <label class="form-check-label" for="debit"> sur plusieurs jours </label>
            </div>

          </div>
          <hr class="my-4">

          <div class="col-md-7" id="divDateDebut">
            <label for="dateDebut" class="form-label">Date de début</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                    <div class="invalid-feedback">
                        Sélectionnez une date de début !
                    </div>
            </div>
            </div>

            <div class="col-md-7" id="divDateFin" style="display: none;">
                <label for="dateFin" class="form-label">Date de fin</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                    <input type="date" class="form-control" id="dateFin" name="dateFin">
                        <div class="invalid-feedback">
                            Sélectionnez une date de fin !
                        </div>
                </div>
            </div>



          <hr class="my-4" />

          <div class="col-sm-6">
            <label for="firstName" class="form-label">Nom de l'Evenements</label>
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


          <hr class="my-4" />
          <button class="w-100 btn btn-primary btn-lg" type="submit">
            Ajouter l'évènement
          </button>
      </form>
    </div>


  </main>

  <?php 
    include("./../main/footer.php");
    ?>

  <br>
  <br>


  </div>
    <script src="./multiJour.js"></script>
    <script src="./checkout.js" class="astro-vvvwv3sm"></script>
</body>

</html>

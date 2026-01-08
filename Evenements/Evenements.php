<?php
require './../Connexion/laConnexion.php';
session_start();

$ordreSQL = "SELECT * FROM Evenements e JOIN Theme t ON e.idT = t.idT JOIN Utilisateurs u ON e.idU = u.idU WHERE e.dateE >= CURDATE() LIMIT 3";
$RequeteP = $pdo->prepare($ordreSQL);
$RequeteP->execute();
$lesEvenements3 = $RequeteP->fetchall();

$ordreSQL = "SELECT * FROM Evenements e JOIN Theme t ON e.idT = t.idT JOIN Utilisateurs u ON e.idU = u.idU";
$RequeteP = $pdo->prepare($ordreSQL);
$RequeteP->execute();
$lesEvenements = $RequeteP->fetchall();


$semaineMap = [
    'Mon' => 'Lun', 'Tue' => 'Mar', 'Wed' => 'Mer', 'Thu' => 'Jeu', 
    'Fri' => 'Ven', 'Sat' => 'Sam', 'Sun' => 'Dim'
];
$moisMap = [
    'Jan' => 'Jan', 'Feb' => 'Fév', 'Mar' => 'Mars', 'Apr' => 'Avr', 
    'May' => 'Mai', 'Jun' => 'Juin', 'Jul' => 'Juil', 'Aug' => 'Août', 
    'Sep' => 'Sep', 'Oct' => 'Oct', 'Nov' => 'Nov', 'Dec' => 'Déc'
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>ISA NET - Evenements</title>



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  
  <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
  

  <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./../Style/css/carousel.css" rel="stylesheet" />
  <link href="./../Style/css/style.css" rel="stylesheet" />


</head>



<body>

    <?php 
    include("./../main/header.php");
    ?>

  <main>

    <!--  ================================================== -->
    <div class="container">

      <hr class="my-4" style="color: white;" />

      <div class="row mb-2 align-items-center justify-content-center">

        <?php 
foreach($lesEvenements as $lEvent){
    
    // CORRECTION 1 : On utilise 'dateE' (nom de la colonne BDD) et pas 'dateD'
    $timestampDebut = strtotime($lEvent['dateE']); 

    // Calculs pour la date de début (valables pour tout le monde)
    $jourEn  = date('D', $timestampDebut);
    $numero  = date('d', $timestampDebut);
    $moisEn  = date('M', $timestampDebut); // "Nov"
    
    // Traduction
    $jourFr = $semaineMap[$jourEn];
    $moisFr = $moisMap[$moisEn];

    // --- CAS 1 : ÉVÉNEMENT SUR PLUSIEURS JOURS ---
    if($lEvent['DateF'] != NULL && $lEvent['DateF'] != $lEvent['dateE']){
        
        $timestampFin = strtotime($lEvent['DateF']);

        // CORRECTION 2 : On utilise bien $timestampFin ici !
        $jourEn2  = date('D', $timestampFin); 
        $numero2  = date('d', $timestampFin);
        $moisEn2  = date('M', $timestampFin);
        
        $jourFr2 = $semaineMap[$jourEn2];
        $moisFr2 = $moisMap[$moisEn2];
?>
    <div class="col-md-1">
      <div class="card text-center shadow-sm">
        <div class="card-body py-3 px-2 d-flex flex-column align-items-center justify-content-center">
          <strong class="text-success-emphasis"><?php echo $jourFr ?></strong>
          <h3 class="mb-0 fw-bold"><?php echo $numero ?></h3>
          <strong class="text-success-emphasis mt-1"><?php echo $moisFr ?></strong>
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
          <strong class="text-success-emphasis"><?php echo $jourFr2 ?></strong>
          <h3 class="mb-0 fw-bold"><?php echo $numero2 ?></h3>
          <strong class="text-success-emphasis mt-1"><?php echo $moisFr2 ?></strong>
        </div>
      </div>
    </div>

    <div class="col-md-8">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="background-color: white;">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis"><?php echo $lEvent['nomT']?></strong>
          <h3 class="mb-0 alterne-couleur-text"><?php echo $lEvent['titreE']?></h3>
          <br>
          <p class="card-text mb-auto alterne-couleur-text"><?php echo $lEvent['descriptionE']?></p>
          <br>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            (publié par <?php echo isset($lEvent['nomU']) ? $lEvent['nomU'] : 'Admin'; ?>)
          </a>
        </div>
      </div>
    </div>

<?php 
    } else { 
   
?>
    <div class="col-md-1">
      <div class="card text-center shadow-sm">
        <div class="card-body p-3">
          <strong class="text-success-emphasis d-block"><?php echo $jourFr ?></strong>
          <h3 class="mb-0"><?php echo $numero ?></h3>
          <strong class="text-success-emphasis d-block mt-2"><?php echo $moisFr ?></strong>
        </div>
      </div>
    </div>

    <div class="col-md-8">
       <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="background-color: white;">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis"><?php echo $lEvent['nomT']?></strong>
          <h3 class="mb-0 alterne-couleur-text"><?php echo $lEvent['titreE']?></h3>
          <br>
          <p class="card-text mb-auto alterne-couleur-text"><?php echo $lEvent['descriptionE']?></p>
          <br>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            (publié par <?php echo isset($lEvent['nomU']) ? $lEvent['nomU'] : 'Admin'; ?>)
          </a>
        </div>
      </div>
    </div>
<?php 
    }
?>

    <div class="col-md-1">
      <div class="card text-center shadow-sm d-flex align-items-center justify-content-center" style="height: 100%;">
        <form action="#" method="POST" class="mb-0">
          <input type="hidden" name="id" value="<?php echo $lEvent['idE'] ?>">
          <button type="submit" class="btn btn-link text-danger p-0" title="Supprimer">
            <i class="bi bi-x-lg fs-4"></i>
          </button>
        </form>
      </div>
    </div>

    <hr class="my-4" style="color: white;" />

<?php
} // Fin du foreach
?>

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



     <a href="http://10.3.17.220/SAE/Evenements/ajoutEvents.php" class="btn btn-primary btn-floating btn-add-course">
            <i class="bi bi-plus-lg me-2"></i>
            Ajouter un evenement
      </a>
  </main>
  <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
  
</body>

</html>

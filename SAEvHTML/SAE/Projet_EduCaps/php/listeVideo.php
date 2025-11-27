<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EduCaps</title>
  <link rel="stylesheet" href="./../css/style.css" type="text/css"/>
</head>
<body>
<div class="screen">
    <?php
    include_once './../connexion.php';
    $leTheme = $_REQUEST["theme"];
    $idTheme = $_REQUEST["id"];
    $page = (int)isset($_REQUEST['pages']) ? (int)$_REQUEST['pages'] : 1;
    $recherche = isset($_REQUEST['txtRech']) ? $_REQUEST['txtRech'] : null;
    $nbVid = 3;
    ?>
    <h1><?php echo $leTheme; ?></h1>
    <form action="./listeVideo.php" method="GET">
    <input type="text" name="txtRech" placeholder="Rechercher" class="recherche"/>
    <br/>
    <input type="hidden" name="id" value="<?php echo $idTheme; ?>"/>
    <input type="hidden" name="theme" value="<?php echo $leTheme; ?>"/>
    <input type="submit" name="cmdEnvoyer" value="Envoyer" class="submit"/>
    </form>
    <div>

    <?php
    if ($recherche == null){
        $ordreSQL = "SELECT Video.idVid, titreVid, descVid, cheminVid, cheminMinia, auteurVid FROM Video JOIN Posseder ON Video.idVid = Posseder.idVid WHERE idTheme=$idTheme";
    }
    else{
        $ordreSQL = "SELECT Video.idVid, titreVid, descVid, cheminVid, cheminMinia, auteurVid FROM Video JOIN Posseder ON Video.idVid = Posseder.idVid WHERE idTheme=$idTheme AND ( descVid LIKE '%$recherche%' OR titreVid LIKE '%$recherche%' )";
    }
    $resultat = $laConnexion->query($ordreSQL);
    $lesVideos = $resultat->fetchall();
    $taille = count($lesVideos);
    if ($lesVideos != null) {
        $items = array_slice($lesVideos, ($page - 1)*$nbVid, 3);
    }
    foreach ($items as $item) {
    ?>
        <a href="./video.php?id=<?php echo $item['idVid']; ?>&theme=<?php echo $leTheme; ?>" class="vidLink">
            <img src ="<?php echo $item['cheminMinia']; ?>" alt="<?php echo $item['titreVid']; ?>" class="left"/>
            <p class="right classic"><?php echo $item['descVid']; ?></p>
        </a>
    <?php }
    ?>            
    </div>

    <?php
    if ($page > 1) {
    ?>
        <a href="./listeVideo.php?pages=<?php echo $page-1; ?>&id=<?php echo $idTheme; ?>&theme=<?php echo $leTheme; ?>&txtRech=<?php echo $recherche; ?>" class="backward"></a>
    <?php
    }
    if ($page <= (int)($taille/3) && ($taille % 3) != 0) {
    ?>
        <a href="./listeVideo.php?pages=<?php echo $page+1; ?>&id=<?php echo $idTheme; ?>&theme=<?php echo $leTheme; ?>&txtRech=<?php echo $recherche; ?>" class="forward"></a>
    <?php
    }
    ?>
    
    <div class="navbar"></div>
    <a id="buttonHome" href="./../index.php"><img class="home" src="./../Design/HomeCheck.webp?v=1.0" alt="Home"/></a>
    <div class="triangle"></div>
    <a class="rectangleL" href="./repertoire.php"></a>
    <a id="buttonPdp" href="./Connex_Inscr.php"><img class="pdp" src="./../Design/PdP.webp?v=1.0" alt="pdp"/></a>
</div>

</body>
</html>
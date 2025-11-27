<?php
    include_once './../connexion.php';
    $pseudo = $_REQUEST['txtPseudo'];
    $mdp = $_REQUEST['pwdMdP'];
    $mail = isset($_REQUEST['txtMail']) ? $_REQUEST['txtMail'] : null;
    $type = $_REQUEST['type'];
    $connex = false;
    
    if ($type === "Connexion") {
        $ordreSQL = "SELECT idUser, pseudoU, typeU, mailU FROM Users WHERE pseudoU = '$pseudo' AND mdpU = '$mdp'";
        $resultat = $laConnexion->query($ordreSQL);
        $user = $resultat->fetch();
        if ($user != null) {
            $_SESSION['pseudo'] = $user['pseudoU'];
            $_SESSION['type'] = $user['typeU'];
            $_SESSION['id'] = $user['idUser'];
            $_SESSION['mail'] = $user['mailU'];
            $connex = true;
        }   
        else {
            $erreur = "Il n'existe pas de compte utilisateur avec ce nom d'utilisateur et ce mot de passe";
        }
    } else if ($type === "Inscription") {
        $ordreVerif = "SELECT pseudoU FROM Users WHERE pseudoU = '$pseudo' OR mailU='$mail'";
        $resultat = $laConnexion->query($ordreVerif);
        $verif = $resultat->fetch();
        if ($verif == null) {
        $ordreSQL = "INSERT INTO Users(typeU, pseudoU, mdpU, mailU) VALUES ('etudiant', '$pseudo', '$mdp', '$mail')";
        $nb = $laConnexion->exec($ordreSQL);
        if ($nb != 0) {
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['type'] = "etudiant";
            $_SESSION['id'] = $laConnexion->lastInsertId();
            $_SESSION['mail'] = $mail;
            $connex = true;
            }
        }
        else {
            $erreur = "Un compte avec ce nom d'utilisateur ou cet adresse mail est déja utilisée";
        }
    }
    if (!$connex) {
        session_destroy();
    } else {
        header("Location: ./utilisateur.php");
        exit;
}
?>

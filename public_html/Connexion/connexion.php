<?php
session_start();
require_once './laConnexion.php';

$erreur = ""; // <-- VARIABLE MESSAGE

if (!empty($_POST['identification']) && !empty($_POST['password'])) {

    $identifiant = htmlspecialchars($_POST['identification']);
    $motpasse = $_POST['password'];

    try {
        $recupUser = $pdo->prepare('SELECT * FROM Utilisateurs WHERE emailU = :idTry');
        $recupUser->bindValue(':idTry', $identifiant, PDO::PARAM_STR);
        $recupUser->execute();

        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();

            if (password_verify($motpasse, $user['mdph'])) {

                // SESSION
                $_SESSION['idU'] = $user['idU'];
                $_SESSION['emailU'] = $user['emailU'];
                $_SESSION['prenomU'] = $user['prenomU'];
                $_SESSION['nomU'] = $user['nomU'];
                $_SESSION['dernierConnexion'] = $user['dernierConnexion'];
                $_SESSION['idF'] = $user['idF'];

                $sqlUpdateConnexion = $pdo->prepare("UPDATE Utilisateurs SET dernierConnexion = NOW() WHERE idU = :idCurrent");
                $sqlUpdateConnexion->bindValue(':idCurrent', $user['idU'], PDO::PARAM_INT);
                $sqlUpdateConnexion->execute();

                header("Location: http://10.3.17.217/TableaudeBord/tableauDeBord.php");
                exit();

            } else {
                $erreur = "Mot de passe incorrect.";
            }

        } else {
            $erreur = "Aucun utilisateur trouvé.";
        }

    } catch (PDOException $erreurPDO) {
        error_log("Erreur PDO : " . $erreurPDO->getMessage());
        $erreur = "Erreur de connexion, réessayez plus tard.";
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $erreur = "Veuillez remplir tous les champs.";
}
header("Location: http://10.3.17.217/Authentification/login.php?erreur=".$erreur)
?>
<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
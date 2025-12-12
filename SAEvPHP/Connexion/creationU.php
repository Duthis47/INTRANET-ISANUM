<?php

session_start(); // Démarrage de la session

try {
    $Connexion = new PDO('mysql:host=localhost;dbname=ISANET', 'adminer', 'Isanum64!', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $erreur) {
    die("Erreur de connexion : " . $erreur->getMessage());
}

if (isset($_POST['cmdsave'])) {
    if (!empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['phone'])) {
        $pseudo = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['phone']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        try {
            // Vérification pseudo ou téléphone déjà existants
            $checkUser = $Connexion->prepare('SELECT * FROM Users WHERE emailU = ? ');
            $checkUser->execute([$emailU]);

            if ($checkUser->rowCount() > 0) {
                $existingUser = $checkUser->fetch();
                if ($existingUser['Pseudo'] === $pseudo) {
                    echo "Un utilisateur avec ce pseudo existe déjà.";
                }
            } else {
                // Insertion des données dans la table Users
                $insertUser = $Connexion->prepare('INSERT INTO Users(Pseudo, Phone, Password, Prenom, Nom) VALUES(?, ?, ?, ?, ?)');
                $insertUser->execute([$pseudo, $tel, $mdp, $prenom, $nom]);

                // Récupération des données pour la session
                $recupUser = $Connexion->prepare('SELECT * FROM Users WHERE Pseudo = ?');
                $recupUser->execute([$pseudo]);

                if ($recupUser->rowCount() > 0) {
                    $user = $recupUser->fetch();
                    $_SESSION['pseudo'] = $user['Pseudo'];
                    $_SESSION['tel'] = $user['Phone'];
                    $_SESSION['id'] = $user['Id'];
                    $_SESSION['prenom'] = $user['Prenom'];
                    $_SESSION['nom'] = $user['Nom'];

                    // Redirection vers une autre page après l'inscription réussie
                    header("Location: http://localhost/projet/Accueil.php"); // Remplacez par la page de votre choix
                    exit(); // N'oubliez pas de terminer le script après la redirection
                    
                } else {
                    echo "Erreur : utilisateur non trouvé après insertion.";
                }
            }
        } catch (PDOException $erreur) {
            error_log("Erreur PDO : " . $erreur->getMessage(), 3, "erreurs.log");
            echo "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    } else {
        echo "Veuillez compléter tous les champs.";
    }
}
?>

<!-- php pour la Connexion des données à la base  -->
<?php
session_start(); // Démarrage de la session

if (isset($_POST['cmdconnect'])) {
    if (!empty($_POST['identifiant']) && !empty($_POST['pwd'])) {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $motpasse = $_POST['pwd']; // Mot de passe saisi par l'utilisateur

        // Requête pour récupérer l'utilisateur en fonction de l'email ou du téléphone
        $recupUser = $Connexion->prepare('SELECT * FROM Users WHERE Pseudo = ? OR Phone = ?');
        $recupUser->execute([$identifiant, $identifiant]); // On recherche avec l'identifiant qui peut être soit un email soit un téléphone

        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();

            // Vérification du mot de passe avec password_verify()
            if (password_verify($motpasse, $user['Password'])) {
                // Si l'identifiant et le mot de passe sont corrects, on démarre une session
                $_SESSION['pseudo'] = $user['Pseudo'];
                $_SESSION['tel'] = $user['Phone'];
                $_SESSION['id'] = $user['Id'];
                $_SESSION['prenom'] = $user['Prenom'];
                $_SESSION['nom'] = $user['Nom'];

                // Redirection vers la page d'accueil après la connexion réussie
                header("Location: http://localhost/projet/Accueil.php"); // Remplacez par la page de votre choix
                exit();
            } else {
                echo "Votre identifiant et/ou mot de passe est incorrect...";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet identifiant.";
        }
    } else {
        echo "Veuillez remplir tous les champs...";
    }
}
?>





<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

?>
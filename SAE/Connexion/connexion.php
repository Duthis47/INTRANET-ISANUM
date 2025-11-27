<?php

session_start();

require_once 'connexion_bdd.php'; 

if (!empty($_POST['identifiant']) && !empty($_POST['pwd'])) {
    
    $identifiant = htmlspecialchars($_POST['identifiant']);
    $motpasse = $_POST['pwd']; 

    try {
        
        $recupUser = $Connexion->prepare('SELECT idU, emailU, Phone, Password, Prenom, Nom FROM Users WHERE emailU = ? OR Phone = ?');
        $recupUser->execute([$identifiant, $identifiant]); 

        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();

            // 2. Vérification du mot de passe haché
            if (password_verify($motpasse, $user['Password'])) {
                
                // 3. Connexion réussie : Définition des variables de session
                $_SESSION['emailU'] = $user['emailU'];
                $_SESSION['tel'] = $user['Phone'];
                $_SESSION['id'] = $user['idU']; // Assurez-vous que 'idU' est le nom correct de la colonne
                $_SESSION['prenom'] = $user['Prenom'];
                $_SESSION['nom'] = $user['Nom'];

                
                
                // Redirection vers la page d'accueil
                header("Location: http://localhost/projet/Accueil.php"); 
                exit();
            } else {
                echo "Votre identifiant et/ou mot de passe est incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet identifiant.";
        }
    } catch (PDOException $erreur) {
        // Enregistrement de l'erreur interne
        error_log("Erreur PDO lors de la connexion : " . $erreur->getMessage(), 0);
        echo "Une erreur est survenue lors de la tentative de connexion. Veuillez réessayer plus tard.";
    }
} else {
    echo "Veuillez remplir tous les champs pour la connexion.";
}

?>
<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<?php
 


// Vérifier si les données sont soumises via POST

// creation des variables
require("fonction.php");
$nom = checkInput($_POST["username"]);
$email = checkInput($_POST["email"]);
$motdepasse = checkInput($_POST["passeword"]);
$role = $_POST["roles"];
$regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";

if (!empty($nom) && !empty($email) && !empty($motdepasse)) {

     // demarrage de la session
     session_start();
     require("admin/config.php");

     // On verifie si l'utilisateur existe
     $stmt = $acces->prepare("SELECT * FROM users WHERE usersame = ? AND email = ?");
     $stmt->execute(array($nom, $email));
     $stmt = $check->fetch();
     $check = $row->rowCount();

    if($row == 0){

        // Valider le nom
        if ( preg_match("/^[a-zA-Z0-9]*$/",$nom)) {
        //   $nom = test_input($_POST["username"]);

            // Valider l'email
            if ( filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // $email = test_input($_POST["email"]);

                    // Valider le mot de passe
                    if ( preg_match($regex, $motdepasse) >= 8) {
                        // $motdepasse = test_input($_POST["passeword"]);

                    
                            // cryptage du mot de passe
                            $motdepasse = password_hash($motdepasse, PASSWORD_BCRYPT);

                            // On insère dans la base de données
                            $insert = $acces->prepare('INSERT INTO users (username, email, passeword, roles, token) VALUES (:username, :email, :passeword, :roles, :token');
                            $insert->execute(array(
                                'username' => $nom,
                                'email' => $email,
                                'passeword' => $motdepasse,
                                'roles' => $role,
                                'token' => bin2hex(openssl_random_pseudo_bytes(64))
                            ));
                            // On redirige avec le message de succès
                            $succes = "Inscription Valider.";

               

                        } else {
                            $erreur = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule et une minuscule, un chiffre et un caractère spécial.";
                        }

                } else {
                    $erreur = "L'adresse e-mail est invalide.";
                }
            } else {
            $erreur = "Le nom est requis et ne doit contenir que des lettres et des espaces.";
            }
    } else {
        $erreur = "L'utilisateur exite déjà.";
    }
}
?>
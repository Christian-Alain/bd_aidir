<?php
// demarrage de la session
session_start();
require("admin/config.php");

// Vérifier si les données sont soumises via POST


$regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";

if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["passeword"])) {
    
    // creation des variables
    // require("fonction.php");
    $nom = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $motdepasse = $_POST["passeword"];
    $role = $_POST["roles"];
     
     

     // On verifie si l'utilisateur existe
     $stmt = $acces->prepare("SELECT * FROM users WHERE  email = ?");
     $stmt->execute(array($email));
     $stmt->fetch();
     $row = $stmt->rowCount();

    if($row == 0){

        // Valider le nom
        if (preg_match("/^[a-zA-Z0-9]*$/",$nom)) {
        //   $nom = test_input($_POST["username"]);

            // Valider l'email
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // $email = test_input($_POST["email"]);

                    // Valider le mot de passe
                    if ( $motdepasse) {
                        // $motdepasse = test_input($_POST["passeword"]);

                    
                            // cryptage du mot de passe
                            $motdepasse = password_hash($motdepasse, PASSWORD_BCRYPT);
                            $token = bin2hex(openssl_random_pseudo_bytes(64));
                            // On insère dans la base de données
                            $insert = $acces->prepare("INSERT INTO users(username, email, passeword, roles, token) VALUES(:username, :email, :passeword, :roles, :token)");
                            $insert->execute(array(
                                'username' => $nom,
                                'email' => $email,
                                'passeword' => $motdepasse,
                                'roles' => $role,
                                'token' => $token
                            ));
                            // On redirige avec le message de succès
                            header('Location: inscription.php?reg_err=success'); 
                            die();

               

                    } else { header('Location: inscription.php?reg_err=password'); die();}
            } else { header('Location: inscription.php?reg_err=email'); die();}
        } else { header('Location: inscription.php?reg_err=nom'); die();}
    } else { header('Location: inscription.php?reg_err=already'); die();}
}

  // Fonction de nettoyage des données
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>



<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Ajouter un Gestionnaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/monstyle.css">
</head>
<body>
<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Inscription du Gestionnaire </div>
        <div class="panel-body">
        <?php
            
            if(isset($_GET['reg_err']))
            {
                $err = test_input($_GET['reg_err']);

                switch($err)
                {
                    case 'success':
                    ?>
                        <div class="alert alert-success">
                            <strong>Succès</strong> inscription réussie !
                        </div>
                    <?php
                    break;

                    case 'password':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur !!</strong> Le mot de passe doit contenir au moins 8 caractères.
                        </div>
                    <?php
                    break;

                    case 'email':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> L'adresse e-mail est invalide.
                        </div>
                   
                    <?php 
                    break;

                    case 'nom':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Le nom est requis et ne doit contenir que des lettres, des chiffres et des espaces.
                        </div>
                    <?php 
                    break;

                    case 'already':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> compte deja existant
                        </div>
                    <?php 

                }
            }
        ?>
            <form method="post" class="form">

                <?php //if (isset($erreur)) { ?>
                    <!-- <div class="alert alert-danger">
                        <?php //echo $erreur ?>
                    </div> -->
                <?php //} ?>
                <?php //if (isset($succes)) { ?>
                    <!-- <div class="alert alert-succes">
                        <?php //echo $succes ?>
                    </div> -->
                <?php //} ?>

                <div class="form-group">
                    <label for="username">Nom utilisateur </label>
                    <input type="text" name="username" placeholder="Nom utilisateur"
                        id="username" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email" placeholder="email"
                        id="email" class="form-control" autocomplete="off"/>
                </div>

                <div class="form-group">
                    <label for="pwd">Mot de passe </label>
                    <input type="password" name="passeword" id="pwd"
                           placeholder="Mot de passe" class="form-control"/>
                </div>
               
                <div class="form-group">
                    <label for="role">Role </label>
                    <div class="">
                        <select type="text" name="roles" id="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="gestionnaire">Gestionnaire</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-log-in"> </span>
                    Valider
                </button>
                &nbsp &nbsp
                <button type="submit" class="btn btn-danger">
                    <span class="glyphicon glyphicon-fa fa-close"></span>
                    Annuler
                </button>
                <!-- <p class="text-right">
                    <a href="InitialiserPwd.php">Mot de passe Oublié</a>

                    &nbsp &nbsp

                    <a href="nouvelUtilisateur.php">Créer un compte</a>
                </p> -->
            </form>
        </div>
    </div>
</div>
</body>
</HTML>

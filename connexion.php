
<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Se connecter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/monstyle.css">
</head>
<body>
<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Se connecter </div>
        <div class="panel-body">
        <?php 
            if(isset($_GET['login_err']))
            {
                $err = htmlspecialchars($_GET['login_err']);

                switch($err)
                {
                    case 'password':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> mot de passe incorrect
                        </div>
                    <?php
                    break;

                    case 'email':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email incorrect
                        </div>
                    <?php
                    break;

                    case 'already':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> compte non existant
                        </div>
                    <?php
                    
                }
            }
        ?>
            <form method="post" action="traitement_connex.php" class="form">

                <?php //if (isset($erreurLogin)) { ?>
                    <!-- <div class="alert alert-danger">
                        <?php //echo $erreurLogin ?>
                    </div> -->
                <?php //} ?>

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

                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-log-in"></span>
                    Se connecter
                </button>
                <p class="text-right">
                    <a href="InitialiserPwd.php">Mot de passe Oublié</a>

                    <!-- &nbsp &nbsp

                    <a href="nouvelUtilisateur.php">Créer un compte</a> -->
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</HTML>

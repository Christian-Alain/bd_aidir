<?php
    session_start();
    require("config.php");

    if(!isset($_SESSION['user'])){
        header("location : ../login.php");
        die();
    }

    $requete = $acces->prepare("SELECT * FROM users WHERE token = ?");
    $requete->execute(array($_SESSION['user']));
    $data = $requete->fetch();

?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des filières</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/monjs.js"></script>
        <script src="../js/jquery-3.3.1.js"></script>
    </head>
    <body>
        <?php require("../menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-success margetop60">
          
				<div class="panel-heading">Rechercher des patients</div>
				<div class="panel-body">
					
					<form method="get" action="filieres.php" class="form-inline">
					
						<div class="form-group">
                            
                            <input type="text" name="nomF" 
                                   placeholder="Nom "
                                   class="form-control"
                                   value=""/>
                                   
                        </div>
                        
                        <label for="niveau"></label>
			            <select name="niveau" class="form-control" id="niveau"
                                onchange="this.form.submit()">
                            <option value="all" <?php //if($niveau==="all") echo "selected" ?>>centre de dialyse</option>
                            <option value="q"   <?php //if($niveau==="q")   echo "selected" ?>>Cocody</option>
                            <option value="t"   <?php //if($niveau==="t")   echo "selected" ?>>Treichville</option>
                            <option value="ts"  <?php //if($niveau==="ts")  echo "selected" ?>>Adjamé</option>
                            <option value="l"   <?php //if($niveau==="l")   echo "selected" ?>>Yopougon</option>
                            <option value="m"   <?php //if($niveau==="m")   echo "selected" ?>>Aboisso</option> 
			            </select>
			            
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;               
                         
					</form>
				</div>
			</div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Liste des patients 
                    &nbsp;&nbsp;
                    
                    <a href="insert.php" class="btn btn-success mx-3"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>
                
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Nom </th>
                                <th>Prenom</th>
                                <th>centre de dialyse</th>
                                <th>parent du dialysé</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    &nbsp;
                                    <a onclick="return confirm('Etes vous sur de vouloir supprimer la filière')"
                                        href="">
                                            <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                                    
                                    
                            </tr>
                            
                       </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </body>
</HTML>
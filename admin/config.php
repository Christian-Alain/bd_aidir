<?php
// try {

//     $pdo = new PDO("mysql:host=localhost;dbname=cnptir_bd",
//         "root", "");

// }catch (Exception $e){
//     die('Erreur : ' . $e->getMessage());

//     //die('Erreur : impossible de se connecter à la base de donnée');
// }

try {
    $acces = new PDO("mysql:host=localhost;dbname=cnptir_bd", "root", "");
  } catch (PDOException $e) {
    echo "Erreur!:" . $e->getMessage() . "<br/>";
    die();
  }
?>
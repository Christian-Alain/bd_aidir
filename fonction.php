<?php
// fonction pour securiser les donnée enter par l'utilisateur
// fail XSS
    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    
?>
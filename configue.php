<?php
require_once(__DIR__.'/Membre.php');
     $servername = "localhost";
     $db = "gestion_membre";
     $username = "root";
     $password = "";

     try{
        $connexion = new PDO("mysql:host=$servername;dbname=$db",$username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $membre = new Membre($connexion, "alpg234", "diallo", "alĥa","18 - 25", "M", "marié", "civile");
     }catch(PDOException $e)
     {
        die('la connexion à la base de donné echoué'.$e->getMessage());
     }
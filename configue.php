<?php
require_once "Membre.php";
     $servername = "localhost";
     $db = "gestion_membre";
     $username = "root";
     $password = "";

     try{
        $connexion = new PDO("mysql:host=$servername;dbname=$db",$username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $membre = new Membre($connexion,"Haps30","Thiam","Haps","18-25 ans","F","celibataire","Badiène Gokh");
        $resultats = $membre->lireMembre();
     }catch(PDOException $e)
     {
        die('la connexion à la base de donné echoué'.$e->getMessage());
     }
<?php
     $servername = "localhost";
     $db = "gestion_membre";
     $username = "root";
     $password = "";

     try{
        $connexion = new PDO("mysql:host=$servername;dbname=$db",$username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     }catch(PDOException $e)
     {
        die('la connexion à la base de donné echoué'.$e->getMessage());
     }
<?php

require_once "Membre.php";
$servername = "localhost";
$db = "gestion_membre";
$username = "root";
$password = "";

try {
    $connexion = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer le dernier matricule
    $query = "SELECT MAX(SUBSTRING(matricule, 5)) as max_matricule FROM membre";
    $result = $connexion->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $lastMatricule = $row['max_matricule'];

    // Incrémenter le matricule
    $nextMatricule = "PATT" . ($lastMatricule + 1);

    // Insérer les données avec le nouveau matricule
    $membre = new Membre($connexion, "Haps30", "Thiam", "Haps", "18-25 ans", "F", "celibataire", "Badiène Gokh", $nextMatricule);
    $membre->ajoutMembre($matricule,$nom,$prenom,$tranche_age,$sexe,$situationMatrimoniale,$statut);
    $membre->lireMembre();

    // Lire les membres après insertion
    $resultats = $membre->lireMembre();

} catch (PDOException $e) {
    die('la connexion à la base de donné echoué' . $e->getMessage());
}

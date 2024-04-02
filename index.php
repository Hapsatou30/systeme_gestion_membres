<?php
require_once 'configue.php'; // Inclure le fichier contenant la conf

// Vérifier si le formulaire est soumis
    if(isset($_POST['enregistrer'])) {
    // Vérifier et récupérer les données
    $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $tranche_age = isset($_POST['tranche_age']) ? $_POST['tranche_age'] : '';
    $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
    $situation_matrimoniale = isset($_POST['situation_matrimoniale']) ? $_POST['situation_matrimoniale'] : '';
    $statut = isset($_POST['statut']) ? $_POST['statut'] : '';

    // Créer un objet Membre avec les données récupérées
   // $membre = new Membre(null, $matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut);
   
    $membre->ajoutMembre($matricule,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un membre</title>
</head>
<body>
    <h1>Ajouter un membre</h1>
    <div style="text-align: center">
        <form action="index.php" method="post">
            <label for="matricule">Matricule :</label>
            <input type="text" id="matricule" name="matricule"><br><br>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom"><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom"><br><br>

            <label for="tranche_age">Tranche d'âge :</label>
            <select id="tranche_age" name="tranche_age">
                <option value="moins_de_18">Moins de 18</option>
                <option value="18_30">18-30</option>
                <option value="30_50">30-50</option>
                <option value="plus_de_50">Plus de 50</option>
            </select><br><br>

            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe">
                <option value="homme">M</option>
                <option value="femme">F</option>
            </select><br><br>


            <label for="situation_matrimoniale">Situation matrimoniale :</label>
            <select id="situation_matrimoniale" name="situation_matrimoniale">
                <option value="celibataire">Célibataire</option>
                <option value="marie">Marié(e)</option>
                <option value="divorce">Divorcé(e)</option>
                <option value="veuf">Veuf/Veuve</option>
            </select><br><br>

            <label for="statut">Statut :</label>
            <input type="text" id="statut" name="statut"><br><br>

            <input type="submit" name="enregistrer" value="Enregistrer">
        </form>

    </div>
</body>
</html>

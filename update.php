<?php
require_once 'configue.php'; // Inclure le fichier contenant la configuration

// Vérifier si le formulaire est soumis
if(isset($_POST['enregistrer'])) {
    // Récupérer les données du formulaire
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tranche_age = $_POST['tranche_age'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut'];

    // Appeler la fonction de mise à jour du membre
    $membre->modifierMembre($matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut);

    // Redirection vers la page index.php après la mise à jour réussie
    header("Location: affichage.php");
    exit(); // Arrêter l'exécution du script après la redirection
}

// Récupérer les données du membre à partir du matricule fourni dans la requête GET
$sql_query = "SELECT * FROM membre WHERE matricule = :matricule";

// Préparation de la requête
$stmt_membre = $connexion->prepare($sql_query);

// Liaison des valeurs aux paramètres
$stmt_membre->bindParam(':matricule', $_GET['matricule'], PDO::PARAM_STR);

// Exécution de la requête
if ($stmt_membre->execute()) {
    // Récupération des résultats de la requête
    $membre = $stmt_membre->fetch(PDO::FETCH_ASSOC);
} else {
    // Gestion de l'erreur en cas d'échec de l'exécution de la requête
    echo "Erreur lors de la récupération des données du membre.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un membre</title>
</head>
<body>
    <h1>Modifier un membre</h1>
    <div style="text-align: center">
        <form action="update.php" method="post">
            <!-- Champs du formulaire -->
            <label for="matricule">Matricule :</label>
            <input type="text" id="matricule" name="matricule" value="<?php echo $membre['matricule']; ?>"><br><br>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $membre['nom']; ?>"><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $membre['prenom']; ?>"><br><br>

            <label for="tranche_age">Tranche d'âge :</label>
            <select id="tranche_age" name="tranche_age">
                <option value="moins_de_18" <?php if($membre['tranche_age'] == 'moins_de_18') echo 'selected'; ?>>Moins de 18</option>
                <option value="18_30" <?php if($membre['tranche_age'] == '18_30') echo 'selected'; ?>>18-30</option>
                <option value="30_50" <?php if($membre['tranche_age'] == '30_50') echo 'selected'; ?>>30-50</option>
                <option value="plus_de_50" <?php if($membre['tranche_age'] == 'plus_de_50') echo 'selected'; ?>>Plus de 50</option>
            </select><br><br>

            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe">
                <option value="homme" <?php if($membre['sexe'] == 'homme') echo 'selected'; ?>>M</option>
                <option value="femme" <?php if($membre['sexe'] == 'femme') echo 'selected'; ?>>F</option>
            </select><br><br>

            <label for="situation_matrimoniale">Situation matrimoniale :</label>
            <select id="situation_matrimoniale" name="situation_matrimoniale">
                <option value="celibataire" <?php if($membre['situation_matrimoniale'] == 'celibataire') echo 'selected'; ?>>Célibataire</option>
                <option value="marie" <?php if($membre['situation_matrimoniale'] == 'marie') echo 'selected'; ?>>Marié(e)</option>
                <option value="divorce" <?php if($membre['situation_matrimoniale'] == 'divorce') echo 'selected'; ?>>Divorcé(e)</option>
                <option value="veuf" <?php if($membre['situation_matrimoniale'] == 'veuf') echo 'selected'; ?>>Veuf/Veuve</option>
            </select><br><br>

            <label for="statut">Statut :</label>
            <input type="text" id="statut" name="statut" value="<?php echo $membre['statut']; ?>"><br><br>

            <input type="submit" name="enregistrer" value="Enregistrer">
        </form>
    </div>
</body>
</html>

<?php
require_once 'configue.php'; // Inclure le fichier contenant la configuration

// Récupérer les données des tables statut et age pour les options du formulaire
$sql_statuts = "SELECT * FROM statut";
$stmt_statuts = $connexion->prepare($sql_statuts);
$stmt_statuts->execute();
$statuts = $stmt_statuts->fetchAll(PDO::FETCH_ASSOC);

$sql_ages = "SELECT * FROM tranche_age";
$stmt_ages = $connexion->prepare($sql_ages);
$stmt_ages->execute();
$ages = $stmt_ages->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le formulaire est soumis
if(isset($_POST['enregistrer'])) {
    // Récupérer les données du formulaire
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $id_statut = $_POST['id_statut'];
    $id_age = $_POST['id_age'];
    $statut_emploi = $_POST['statut_emploi'];

    // Appeler la fonction de mise à jour du membre
    $membre->modifierMembre($matricule, $nom, $prenom, $sexe, $situation_matrimoniale, $id_statut, $id_age, $statut_emploi);

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
    <link rel="stylesheet" href="update.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <h1 style="color: #3498db;">Modifier un membre</h1>
    </div>
    <div class="container" style="width: 700px;">
        <div style="text-align: center">
            <form action="update.php" method="post">
                <!-- Champs du formulaire -->
                <div class="form-group">
                    <label for="matricule">Matricule :</label>
                    <input type="text" id="matricule" name="matricule" value="<?php echo $membre['matricule']; ?>" readonly><br><br>
                </div>

                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo $membre['nom']; ?>"><br><br>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo $membre['prenom']; ?>"><br><br>
                </div>

               
                <div class="form-group">
                    <label for="sexe">Sexe :</label>
                    <select id="sexe" name="sexe">
                        <option value="Masculin" <?php if($membre['sexe'] == 'homme') echo 'selected'; ?>>Masc</option>
                        <option value="Feminin" <?php if($membre['sexe'] == 'femme') echo 'selected'; ?>>Femin</option>
                    </select><br><br>
                </div>

                <div class="form-group">
                    <label for="situation_matrimoniale">Situation matrimoniale :</label>
                    <select id="situation_matrimoniale" name="situation_matrimoniale">
                        <option value="celibataire" <?php if($membre['situation_matrimoniale'] == 'Célibataire') echo 'selected'; ?>>Célibataire</option>
                        <option value="marie" <?php if($membre['situation_matrimoniale'] == 'Marié(e)') echo 'selected'; ?>>Marié(e)</option>
                        <option value="divorce" <?php if($membre['situation_matrimoniale'] == 'Divorcé(e)') echo 'selected'; ?>>Divorcé(e)</option>
                        <option value="veuf" <?php if($membre['situation_matrimoniale'] == 'Veuf(ve)') echo 'selected'; ?>>Veuf/Veuve</option>
                    </select><br><br>
                </div>

                <div class="form-group">
    <label for="id_statut">Statut :</label>
    <select id="id_statut" name="id_statut">
        <?php foreach ($statuts as $statut): ?>
            <option value="<?php echo $statut['id']; ?>" <?php if ($statut['id'] == $membre['id_statut']) echo 'selected'; ?>><?php echo $statut['titre']; ?></option>
        <?php endforeach; ?>
    </select>
</div><br>
<div class="form-group">
    <label for="id_age">Tranche d'âge :</label>
    <select id="id_age" name="id_age">
        <?php foreach ($ages as $age): ?>
            <option value="<?php echo $age['id']; ?>" <?php if ($age['id'] == $membre['id_age']) echo 'selected'; ?>><?php echo $age['min_age'] . ' - ' . $age['max_age']; ?></option>
        <?php endforeach; ?>
    </select>
</div><br>
                <div class="form-group">
                    <label for="statut_emploi">Statut d'emploi :</label>
                    <select id="statut_emploi" name="statut_emploi">
                        <option value="Chômeur" <?php if($membre['statut_emploi'] == 'Chômeur') echo 'selected'; ?>>Chômeur</option>
                        <option value="Non chômeur" <?php if($membre['statut_emploi'] == 'Non chômeur') echo 'selected'; ?>>Non chômeur</option>
                    </select>
                </div><br>

                <input type="submit" name="enregistrer" value="Enregistrer">
            </form>
        </div>
    </div>
</body>
</html>

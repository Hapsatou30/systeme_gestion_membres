<?php
require_once 'configue.php'; // Inclure le fichier contenant la configuration

// Vérification si le matricule est fourni dans la requête GET
if (!isset($_GET['matricule'])) {
    // Gérer le cas où aucun matricule n'est fourni
    echo "Aucun matricule n'est fourni.";
    exit();
}

// Récupérer les données du membre à partir du matricule fourni dans la requête GET
$sql_query = "SELECT * FROM membre WHERE matricule = :matricule";

// Préparation de la requête
$stmt_membre = $connexion->prepare($sql_query);

// Liaison des valeurs aux paramètres
$stmt_membre->bindParam(':matricule', $_GET['matricule'], PDO::PARAM_STR);

// Exécution de la requête
if ($stmt_membre->execute()) {
    // Vérifier si le membre existe
    if ($membre = $stmt_membre->fetch(PDO::FETCH_ASSOC)) {
        // Continuer avec l'affichage du formulaire
    } else {
        // Gérer le cas où aucun membre n'est trouvé avec le matricule fourni
        echo "Aucun membre trouvé avec ce matricule.";
        exit();
    }
} else {
    // Gestion de l'erreur en cas d'échec de l'exécution de la requête
    echo "Erreur lors de la récupération des données du membre.";
    exit();
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
    <h1 style="color: #3498db ;">Modifier un membre</h1>
    </div>
<div class="container" style="width: 700px;">
    <div style="text-align: center">
        <form action="update.php" method="post">
            <!-- Champs du formulaire -->
            <div class="form-group">
                <label for="matricule">Matricule :</label>
                <input type="text" id="matricule" name="matricule" value="<?php echo $membre['matricule']; ?>"><br><br>
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
                <label for="tranche_age">Tranche d'âge :</label>
                <select id="tranche_age" name="tranche_age">
                    <option value="moins_de_18" <?php if($membre['id_age'] == 'moins_de_18') echo 'selected'; ?>>Moins de 18</option>
                    <option value="18_30" <?php if($membre['id_age'] == '18_30') echo 'selected'; ?>>18-30</option>
                    <option value="30_50" <?php if($membre['id_age'] == '30_50') echo 'selected'; ?>>30-50</option>
                    <option value="plus_de_50" <?php if($membre['id_age'] == 'plus_de_50') echo 'selected'; ?>>Plus de 50</option>
                </select><br><br>
            </div>

            <div class="form-group">
                <label for="sexe">Sexe :</label>
                <select id="sexe" name="sexe">
                    <option value="homme" <?php if($membre['sexe'] == 'homme') echo 'selected'; ?>>M</option>
                    <option value="femme" <?php if($membre['sexe'] == 'femme') echo 'selected'; ?>>F</option>
                </select><br><br>
            </div>

            <div class="form-group">
                <label for="situation_matrimoniale">Situation matrimoniale :</label>
                <select id="situation_matrimoniale" name="situation_matrimoniale">
                    <option value="celibataire" <?php if($membre['situation_matrimoniale'] == 'celibataire') echo 'selected'; ?>>Célibataire</option>
                    <option value="marie" <?php if($membre['situation_matrimoniale'] == 'marie') echo 'selected'; ?>>Marié(e)</option>
                    <option value="divorce" <?php if($membre['situation_matrimoniale'] == 'divorce') echo 'selected'; ?>>Divorcé(e)</option>
                    <option value="veuf" <?php if($membre['situation_matrimoniale'] == 'veuf') echo 'selected'; ?>>Veuf/Veuve</option>
                </select><br><br>
            </div>

            <div class="form-group">
                <label for="statut">Statut :</label>
                <select id="statut" name="statut">
                    <?php
                    // Requête pour récupérer tous les statuts disponibles
                    $sql_statuts = "SELECT * FROM statut";
                    $stmt_statuts = $connexion->query($sql_statuts);
                    
                    // Parcourir les résultats et afficher chaque option
                    while ($row_statut = $stmt_statuts->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($row_statut['titre'] == $membre['id_statut']) ? 'selected' : '';
                        echo '<option value="' . $row_statut['titre'] . '" ' . $selected . '>' . $row_statut['titre'] . '</option>';
                    }
                    ?>
                </select><br><br>
            </div>

            <input type="submit" name="enregistrer" value="Enregistrer">
        </form>
    </div>
</div>

</body>
</html>

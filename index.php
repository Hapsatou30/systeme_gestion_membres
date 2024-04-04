<?php
require_once 'configue.php'; // Inclure le fichier contenant la conf

// Vérifier si le formulaire est soumis
if(isset($_POST['enregistrer'])) {
    // Vérifier et récupérer les données
    $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';

    // Récupérer les données manquantes à partir de la base de données

    // Exemple de récupération de la tranche d'âge
    $requete_age = $connexion->prepare('SELECT id FROM tranche_age WHERE min_age <= :age AND max_age >= :age');
    $requete_age->bindValue(':age', $age); // À remplacer par votre logique pour récupérer l'âge correspondant
    $requete_age->execute();
    $resultat_age = $requete_age->fetch(PDO::FETCH_ASSOC);
    $tranche_age = $resultat_age['id'];

    // Exemple de récupération du sexe
    $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : ''; // Vous récupérez directement la valeur du formulaire

    // Exemple de récupération de la situation matrimoniale
    $situationMatrimoniale = isset($_POST['situation_matrimoniale']) ? $_POST['situation_matrimoniale'] : ''; // Vous récupérez directement la valeur du formulaire

    // Exemple de récupération du statut
    $requete_statut = $connexion->prepare('SELECT id FROM statut WHERE titre = :titre');
    $requete_statut->bindValue(':titre', $statut_utilisateur); // À remplacer par votre logique pour récupérer le statut correspondant
    $requete_statut->execute();
    $resultat_statut = $requete_statut->fetch(PDO::FETCH_ASSOC);
    $statut = $resultat_statut['id'];

    // Créer un objet Membre avec les données récupérées
    $membre->ajoutMembre($matricule, $nom, $prenom, $tranche_age, $sexe, $situationMatrimoniale, $statut);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un membre</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <h1 style="color: #3498db;">Ajouter un membre à la Commune de Patte D'oie</h1>
    </div>
    <a href="affichage.php" style="position: absolute; top: 0; right: 0; margin: 20px; display: inline-block; text-decoration: none; background-color: #3498db; padding: 10px 20px; border-radius: 20px; color: #ffffff; font-size: 20px;">Voir la liste des membres</a>
    
    <div class="container" style="width: 700px; margin: auto;">
        <div style="text-align: center;">
            <form action="index.php" method="post">
                <div class="mb-3">
                    <label for="matricule" class="form-label">Matricule :</label>
                    <input type="text" id="matricule" name="matricule" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="tranche_age" class="form-label">Tranche d'âge :</label>
                    <select id="tranche_age" name="tranche_age" class="form-select">
                        <?php foreach ($tranche_ages as $tranche_age): ?>
                            <option value="<?php echo $tranche_age['id']; ?>"><?php echo $tranche_age['min_age'] . '-' . $tranche_age['max_age']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sexe" class="form-label">Sexe :</label>
                    <select id="sexe" name="sexe" class="form-select">
                        <option value="Masculin">Masc</option>
                        <option value="Feminin">Femin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="situation_matrimoniale" class="form-label">Situation matrimoniale :</label>
                    <select id="situation_matrimoniale" name="situation_matrimoniale" class="form-select">
                        <?php foreach ($situation_matrimoniales as $situation_matrimoniale): ?>
                            <option value="<?php echo $situation_matrimoniale['id']; ?>"><?php echo $situation_matrimoniale['situation']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut :</label>
                    <select id="statut" name="statut" class="form-select">
                        <?php foreach ($statuts as $statut): ?>
                            <option value="<?php echo $statut['id']; ?>"><?php echo $statut['titre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="enregistrer" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
</html>

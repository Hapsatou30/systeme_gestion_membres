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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<a href="affichage.php" style="position: absolute;
     top: 0; right: 0; margin: 20px; display: inline-block;
    text-decoration: none; background-color: #3498db; 
    padding: 10px 20px; border-radius: 20px; color: #ffffff; 
    font-size: 20px;">Voir la liste des membres</a>
    f
    <div class="container" style="width: 700px;">
        <h1 style="color: #3498db ;">Ajouter un membre à la Commune de Patte D'oie</h1>
        <div style="text-align: center">
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="matricule">Matricule :</label>
                    <input type="text" id="matricule" name="matricule">
                </div><br>

                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom">
                </div><br>

                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom">
                </div><br>

                <div class="form-group">
                    <label for="tranche_age">Tranche d'âge :</label>
                    <select id="tranche_age" name="tranche_age">
                        <option value="moins_de_18">Moins de 18</option>
                        <option value="18_30">18-30</option>
                        <option value="30_50">30-50</option>
                        <option value="plus_de_50">Plus de 50</option>
                    </select>
                </div><br>

                <div class="form-group">
                    <label for="sexe">Sexe :</label>
                    <select id="sexe" name="sexe">
                        <option value="homme">M</option>
                        <option value="femme">F</option>
                    </select>
                </div><br>

                <div class="form-group">
                    <label for="situation_matrimoniale">Situation matrimoniale :</label>
                    <select id="situation_matrimoniale" name="situation_matrimoniale">
                        <option value="celibataire">Célibataire</option>
                        <option value="marie">Marié(e)</option>
                        <option value="divorce">Divorcé(e)</option>
                        <option value="veuf">Veuf/Veuve</option>
                    </select>
                </div><br>

                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <input type="text" id="statut" name="statut">
                </div><br>

                <input type="submit" name="enregistrer" value="Enregistrer">
        </form>


        </div>
    </div>
</body>
</html>

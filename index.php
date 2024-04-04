<?php
require_once 'configue.php'; // Inclure le fichier contenant la configuration de la base de données

try {
    // Récupérer les statuts depuis la base de données
    $sql_statut = "SELECT * FROM statut";
    $stmt_statut = $connexion->prepare($sql_statut);
    $stmt_statut->execute();
    $statuts = $stmt_statut->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les tranches d'âge depuis la base de données
    $sql_age = "SELECT * FROM tranche_age";
    $stmt_age = $connexion->prepare($sql_age);
    $stmt_age->execute();
    $ages = $stmt_age->fetchAll(PDO::FETCH_ASSOC);
    $membre = new Membre($connexion,"PATT1","Thiam","Haps","Feminin","situationMatrimoniale","statu","tranche_age","statut_emploi");

    // Vérifier si le formulaire est soumis
    if (isset($_POST['enregistrer'])) {
        // Récupérer les données du formulaire
        $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : '';
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
        $situation_matrimoniale = isset($_POST['situation_matrimoniale']) ? $_POST['situation_matrimoniale'] : '';
        $id_statut = isset($_POST['id_statut']) ? $_POST['id_statut'] : '';
        $id_age = isset($_POST['id_age']) ? $_POST['id_age'] : '';
        $statut_emploi = isset($_POST['statut_emploi']) ? $_POST['statut_emploi'] : '';

        // Vérifier si le nom est vide ou contient des chiffres
        if (empty($nom) || preg_match('/[0-9]/', $nom)) {
            echo "Erreur : Le nom est vide ou contient des chiffres.";
            exit(); // Arrêter l'exécution du script
        }

        // Vérifier si le prénom est vide ou contient des chiffres
        if (empty($prenom) || preg_match('/[0-9]/', $prenom)) {
            echo "Erreur : Le prénom est vide ou contient des chiffres.";
            exit(); // Arrêter l'exécution du script
        }

        // Effectuer l'ajout du membre
        $membre->ajoutMembre($matricule, $nom, $prenom, $sexe, $situation_matrimoniale, $id_statut, $id_age, $statut_emploi);
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
    <img src="./images/senegal.svg.png" alt="">
    <h1 >Ajouter un membre à la Commune de Patte D'oie</h1>
</div>
<a href="affichage.php" class="bouton">Voir la liste des membres</a>

<div class="container" style="width: 700px;">
    <div style="text-align: center">
    <form action="index.php" method="post">
    <div class="form-group">
    <label for="matricule">Matricule :</label>
    <input type="text" id="matricule" name="matricule" value="<?php echo genererMatricule($connexion); ?>">
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
        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe">
            <option value="Masculin">Masc</option>
            <option value="Feminin">Femin</option>
        </select>
    </div><br>

    <div class="form-group">
        <label for="situation_matrimoniale">Situation matrimoniale :</label>
        <select id="situation_matrimoniale" name="situation_matrimoniale">
            <option value="Célibataire">Célibataire</option>
            <option value="Marié(e)">Marié(e)</option>
            <option value="Divorcé(e)">Divorcé(e)</option>
            <option value="Veuf(ve)">Veuf/Veuve</option>
        </select>
    </div><br>
    <div class="form-group">
    <label for="id_statut">Statut :</label>
    <select id="id_statut" name="id_statut">
        <?php foreach ($statuts as $statut): ?>
            <option value="<?php echo $statut['id']; ?>"><?php echo $statut['titre']; ?></option>
        <?php endforeach; ?>
    </select>
</div><br>

<div class="form-group">
    <label for="id_age">Tranche d'âge :</label>
    <select id="id_age" name="id_age">
        <?php foreach ($ages as $age): ?>
            <option value="<?php echo $age['id']; ?>"><?php echo $age['min_age'] . ' - ' . $age['max_age']; ?></option>
        <?php endforeach; ?>
    </select>
</div><br>

    <div class="form-group">
        <label for="statut_emploi">Statut d'emploi :</label>
        <select id="statut_emploi" name="statut_emploi">
            <option value="Chômeur">Chômeur</option>
            <option value="Non chômeur">Non chômeur</option>
        </select>
    </div><br>

    <input type="submit" name="enregistrer" value="Enregistrer">
</form>

    </div>
</div>
</body>
</html>
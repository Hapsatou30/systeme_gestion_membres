<?php
require_once 'configue.php'; // Inclure le fichier contenant la conf

try {
    // Créer une connexion PDO
    $connexion = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire est soumis
    if (isset($_POST['enregistrer'])) {
        // Vérifier et récupérer les données
        $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : '';
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $tranche_age = isset($_POST['tranche_age']) ? $_POST['tranche_age'] : '';
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
        $situation_matrimoniale = isset($_POST['situation_matrimoniale']) ? $_POST['situation_matrimoniale'] : '';
        $statut = isset($_POST['statut']) ? $_POST['statut'] : '';

        // Après avoir récupéré les données du formulaire
        require_once 'CRUD.php'; // Inclure le fichier contenant la classe Membre
        $membre = new Membre($connexion, $matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut);

        $membre->ajoutMembre($matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut);
    }

    //requêtte sql pour afficher situation matrimonial 
    $requette = "SELECT DISTINCT situation_matrimoniale FROM membre";
    $stmt = $connexion->query($requette);
    $situation_matrimoniales = $stmt->fetchAll(PDO::FETCH_COLUMN);


    // Requête SQL pour récupérer toutes les tranches d'âge
    $query = "SELECT * FROM tranche_age";
    $statement = $connexion->query($query);
    $tranche_age = $statement->fetchAll(PDO::FETCH_ASSOC);

    //reqêtte pour afficher les statut 
    $sql = "SELECT * FROM statut";
    $statement_statut = $connexion->query($sql);
    $statut = $statement_statut->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Gérer les erreurs de connexion ou d'exécution de la requête
    die('La connexion à la base de données a échoué : ' . $e->getMessage());
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
    <h1 style="color: #3498db;">Ajouter un membre à la Commune de Patte D'oie</h1>
</div>
<a href="affichage.php" style="position: absolute;
     top: 0; right: 0; margin: 20px; display: inline-block;
    text-decoration: none; background-color: #3498db; 
    padding: 10px 20px; border-radius: 20px; color: #ffffff; 
    font-size: 20px;">Voir la liste des membres</a>


    <div class="container" style="width: 700px;">
        <div style="text-align: center">
            <form action="index.php" method="post">
                <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" id="matricule" readonly value="<?php echo $nextMatricule; ?>">
                </div><br>

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom">
            </div><br>

            <div class="form-group">

<div class="container" style="width: 700px;">
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
                <label for="tranche_age">Tranche d'âge :</label>
                <select id="tranche_age" name="tranche_age">
                    <?php foreach ($tranche_age as $tranch): ?>
                        <option
                            value="<?php echo $tranch['min_age'] . '_' . $tranch['max_age']; ?>"><?php echo $tranch['min_age'] . '-' . $tranch['max_age']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div class="form-group">

         <label for="statut">Statut :</label>
            <select id="statut" name="statut">
            <?php foreach ($statut as $s): ?>
            <option value="<?php echo $s['id']; ?>"><?php echo $s['titre']; ?></option>
            <?php endforeach; ?>
            </select>
            </div><br>

            <br>

            <input type="submit" name="enregistrer" value="Enregistrer">
        </form>
    </div>
</div>
</body>
</html>
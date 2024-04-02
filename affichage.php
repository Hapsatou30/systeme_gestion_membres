<?php
    require_once "Membre.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion_Membres</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <h2>La liste des membre de la commune de Patte D'oie</h2>
    <?php foreach($resultats as $membre) {?>
        <div class="col">
            <div class="card">
                <img src="./images/images-removebg-preview.png" class="card-img-top" alt="...">
                <div class="card-body" style="height: 390px;">
                    <h5 class="card-title" style="color: #FE7A15;"><i class="fas fa-city"></i>  N° de matricule : <?php echo' '. $row['matricule'] ?></h5>
                    <div class="membre">
                        <div class="nom">
                            <h6 style="color: #FE7A15;">Prenom et Nom</h6>
                            <p class="card-text"><?php echo $row['prenom']. ' ' . $row['nom']; ?> </p>
                        </div>
                        <div class="tranche-age">
                            <h6 style="color: #FE7A15;">Tranche d'âge</h6>
                            <p class="card-text"><?php echo $row['tranche_age']; ?></p>
                        </div>
                        <div class="sexe">
                            <h6 style="color: #FE7A15;">Sexe</h6>
                            <p class="card-text"><?php echo $row['sexe']; ?></p>
                        </div>
                        <div class="situation-matrimoniale">
                            <h6 style="color: #FE7A15;">Situation matrimoniale</h6>
                            <p class="card-text"><?php echo $row['situation_matrimoniale']; ?></p>
                        </div>
                        <div class="statut">
                            <h6 style="color: #FE7A15;">Statut</h6>
                            <p class="card-text"><?php echo $row['statut']; ?></p>
                        </div>
                    </div>
                    <div class="update_delete">
                        <div class="update"> 
                            <a href="update_billet.php?matricule=<?php echo $row['matricule']; ?>" class="btn"><i class="fas fa-edit"></i></a>
                        </div>
                        <div class="delete">
                            <a href="delete_billet.php?matricule=<?php echo $row['matricule']; ?>" class="btn"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>          
                                   
                </div>     
            </div>
        </div>
    <?php
    } ?>
    
</body>
</html>
<?php
    require_once "configue.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion_Membres</title>
    <link rel="stylesheet" href="affichage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
<h2 >La liste des membres de la commune de Patte D'oie</h2>
</div>

    <a href="index.php" style="margin: 20px; 
                
            display: inline-block; 
            text-decoration: none; 
            background-color: #3498db;
            padding: 10px 20px; 
            border-radius: 20px;
            color: #ffff;
            font-size:20px;"
            >Ajouter un Membre
        </a>
    <div class="container">
        <div class="row">
            <?php foreach($resultats as $membre) {?>
                <div class="col-lg-4"> <!-- Utilisation de col-md-6 pour afficher deux cartes par ligne sur les écrans de taille moyenne et plus grands -->
                    <div class="card mb-4">
                        <img src="./images/images-removebg-preview.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #3498db; font-size: 28px;"><i class="fas fa-city"></i>  N° de  	matricule : <?php echo ' '. $membre['matricule']; ?></h5>
                            <div class="membre">
                                <div class="nom">
                                    <h6 style="color: #3498db;" >Prenom et Nom  :  </h6>
                                    <p class="card-text"><?php echo $membre['prenom']. ' ' . $membre['nom']; ?> </p>
                                </div>
                                <div class="tranche-age">
                                    <h6 style="color: #3498db;">Tranche d'âge  :</h6>
                                    <p class="card-text"><?php echo " " .$membre['id_age']; ?></p>
                                </div>
                                <div class="sexe">
                                    <h6 style="color: #3498db;">Sexe  :</h6>
                                    <p class="card-text"><?php echo $membre['sexe']; ?></p>
                                </div>
                                <div class="situation-matrimoniale">
                                    <h6 style="color: #3498db;">Situation matrimoniale  :</h6>
                                    <p class="card-text"><?php echo $membre['situation_matrimoniale']; ?></p>
                                </div>
                                <!-- <div class="statut">
                                    <h6 style="color: #3498db;">Statut  :</h6>
                                    <p class="card-text"><?php echo $membre['id_statut']; ?></p>
                                </div> -->
                            </div>
                            <div class="update_delete">
                                <div class="update"> 
                                    <a href="update.php?matricule=<?php echo $membre['matricule']; ?>" class="btn" style="font-size: 28px; color: #3498db ;"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="delete">
                                    <a href="delete.php?matricule=<?php echo $membre['matricule']; ?>" class="btn" style="font-size: 28px; color: red;"><i class="fas fa-trash-alt"></i></a>
                                </div>

                            </div>          
                        </div>     
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

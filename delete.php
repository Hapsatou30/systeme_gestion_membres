<?php
require(__DIR__ . '/configue.php'); // Corrected the file name to 'config.php'

if(isset($_GET['matricule'])){
    $matricule = $_GET['matricule'];
}
$membre->supprimerMembre($matricule);

header ('location: affichage.php');
exit();


?>



 <?php


 require_once "Membre.php";
 $servername = "localhost";
 $db = "gestion_membre";
 $username = "root";
 $password = "";
 
      try{
         $connexion = new PDO("mysql:host=$servername;dbname=$db",$username, $password);
         $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $membre = new Membre($connexion,"PATT1","Thiam","Haps","Feminin","situationMatrimoniale","statu","tranche_age","statut_emploi");
         $resultats = $membre->lireMembre();
 
 
 
      }catch(PDOException $e)
      {
         die('la connexion à la base de donné echoué'.$e->getMessage());
      }
      function genererMatricule($connexion) {
        // Requête pour obtenir le dernier matricule enregistré
        // Requête pour obtenir le dernier matricule enregistré
        $sql = "SELECT MAX(CAST(SUBSTRING(matricule, 5) AS UNSIGNED)) AS dernier_numero FROM membre";

        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $dernier_numero = $stmt->fetchColumn();
    
        // Si aucun matricule enregistré, initialiser le numéro à 0
        if (!$dernier_numero) {
            $dernier_numero = 0;
        }
    
        // Incrémenter le numéro de matricule
        $nouveau_numero = $dernier_numero + 1;
    
        // Formater le nouveau matricule en ajoutant le préfixe "PATT1"
        $nouveau_matricule = "PATT" . $nouveau_numero;
    
        return $nouveau_matricule;
    }
    

// require_once "Membre.php";
// $servername = "localhost";
// $db = "gestion_membre";
// $username = "root";
// $password = "";

// try {
//     $connexion = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
//     $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Récupérer le dernier matricule
//    //  Cette ligne définit une requête SQL pour sélectionner le maximum de la sous-chaîne de 
//    //  chaque matricule à partir du cinquième caractère (caractères après "PATT"). 
//    //  Cela signifie qu'elle récupère le numéro le plus élevé du matricule dans la table "membre".
//     $query = "SELECT MAX(SUBSTRING(matricule, 5)) as max_matricule FROM membre";
//     $result = $connexion->query($query);
//     $row = $result->fetch(PDO::FETCH_ASSOC);
//     $lastMatricule = $row['max_matricule'];
//     // Incrémenter le matricule
//     $nextMatricule = "PATT" . ($lastMatricule + 1);

//     // Insérer les données avec le nouveau matricule
//     $membre = new Membre($connexion,"PATT1","Thiam","Haps","Feminin","situationMatrimoniale","statu","tranche_age","statut_emploi");
//       // Appel de la méthode ajoutMembre pour insérer le nouveau membre
//       $membre->ajoutMembre($nextMatricule, "Thiam","Haps","Feminin","situationMatrimoniale","statu","tranche_age","statut_emploi");
//     $membre->lireMembre();

//     // Lire les membres après insertion
//     $resultats = $membre->lireMembre();



//      }catch(PDOException $e)
//      {
//         die('la connexion à la base de donné echoué'.$e->getMessage());
//      } 
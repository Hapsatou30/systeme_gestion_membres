
<?php
require_once "CRUD.php";
//creation de la prenome Membre
class Membre implements CRUD
{
    //déclaration des proprietes privées 
    private $connexion;
    private $matricule;
    private $nom;
    private $prenom;
    private $sexe;
    private $situationMatrimoniale;
    private $statut;
    private $tranche_age;
    private $statut_emploi;

    //la methode construct
     public function __construct($connexion,$matricule,$nom,$prenom,$sexe,$situationMatrimoniale,$statut,$tranche_age,$statut_emploi)
     {
        $this->connexion=$connexion;
        $this->matricule=$matricule;
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->sexe=$sexe;
        $this->situationMatrimoniale=$situationMatrimoniale;
        $this->statut=$statut;
        $this->tranche_age=$tranche_age;
        $this->statut_emploi=$statut_emploi;
     }

     //les methodes de getters et setters

     public function getMatricule()
     {
        return $this->matricule;
     }

     public function setMatricule($nouveauMatricule)
     {
        $this->matricule=$nouveauMatricule;
     }

     public function getNom()
     {
        return $this->nom;
     }

     public function setNom($nouveauNom)
     {
         // Vérification que le nom n'est pas vide et qu'il ne contient que des lettres et espaces
         if (!empty($nouveauNom) && preg_match('/^[a-zA-Z\s]+$/', $nouveauNom)) {
             $this->nom = $nouveauNom;
         } else {
             throw new InvalidArgumentException("Le nom doit être une chaîne non vide contenant uniquement des lettres et des espaces.");
         }
     }
     public function getprenom()
     {
        return $this->prenom;
     }

     public function setPrenom($nouveauPrenom)
     {
         // Vérification que le prénom n'est pas vide et qu'il ne contient que des lettres et espaces
         if (!empty($nouveauPrenom) && preg_match('/^[a-zA-Z\s]+$/', $nouveauPrenom)) {
             $this->prenom = $nouveauPrenom;
         } else {
             throw new InvalidArgumentException("Le prénom doit être une chaîne non vide contenant uniquement des lettres et des espaces.");
         }
     }
     public function getTrancheAge()
     {
        return $this->tranche_age;
     }

     public function setTrancheAge($nouveauTrancheAge)
     {
        $this->tranche_age=$nouveauTrancheAge;
     }
     public function getSexe()
     {
        return $this->sexe;
     }

     public function setSexe($nouveauSexe)
     {
        $this->sexe=$nouveauSexe;
     }
     public function getSituationMatri()
     {
        return $this->situationMatrimoniale;
     }

     public function setSituationMatri($nouveauSituationMatri)
     {
        $this->situationMatrimoniale=$nouveauSituationMatri;
     }
     public function getStatut()
     {
        return $this->statut;
     }
     public function setStatut($nouveauStatut)
     {
        $this->statut=$nouveauStatut;
     }
     public function getStatutEmploi()
     {
        return $this->statut_emploi;
     }
     public function setStatutEmploi($nouveauStatutEmploi)
     {
        $this->statut_emploi=$nouveauStatutEmploi;
     }

    

     //la methode pour ajouter un membre

    //la methode pour ajouter un membre
    public function ajoutMembre($matricule, $nom, $prenom, $sexe, $situation_matrimoniale, $id_statut, $id_age, $statut_emploi)
    {
        try {
            $requete_insertion = "INSERT INTO membre (matricule, nom, prenom, sexe, situation_matrimoniale, id_statut, id_age, statut_emploi) VALUES (:matricule, :nom, :prenom, :sexe, :situation_matrimoniale, :id_statut, :id_age, :statut_emploi)";
            $stmt_insertion = $this->connexion->prepare($requete_insertion); // Utilisation de $this->connexion
            $stmt_insertion->bindParam(':matricule', $matricule);
            $stmt_insertion->bindParam(':nom', $nom);
            $stmt_insertion->bindParam(':prenom', $prenom);
            $stmt_insertion->bindParam(':sexe', $sexe);
            $stmt_insertion->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            $stmt_insertion->bindParam(':id_statut', $id_statut);
            $stmt_insertion->bindParam(':id_age', $id_age);
            $stmt_insertion->bindParam(':statut_emploi', $statut_emploi);
            $stmt_insertion->execute();
            header("Location: affichage.php");
            exit();
        } catch(PDOException $e) {
            echo 'Erreur lors de l\'insertion : '.$e->getMessage();
        }
    }
    
   //la methode pour afficher les informations des membre
   public function lireMembre()
   {
      try {
         // La requête SQL pour récupérer les informations complètes des membres avec les données associées des tables statut et tranche_age
         $sql = "SELECT m.*, s.titre AS statut, CONCAT(t.min_age, '-', t.max_age) AS tranche_age 
                  FROM membre m
                  JOIN statut s ON m.id_statut = s.id
                  JOIN tranche_age t ON m.id_age = t.id";

         //préparer la requette
         $stmt= $this->connexion->prepare($sql);

         //exécute la requette 
         $stmt->execute();
         
         //récupération des résultats dans un tableau
         $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

         return $resultats;
         
      } catch (PDOException $e) {
         //gestion des erreurs
         die("::ERREUR:: Impossible de d'afficher les détails des membres");
      } 
   }

     
   public function modifierMembre($matricule, $nom, $prenom, $sexe, $situationMatrimoniale, $id_statut, $id_age, $statut_emploi)
   {
       try {
           // Requête SQL de mise à jour avec des paramètres
           $sql = "UPDATE membre SET nom = :nom, prenom = :prenom, sexe = :sexe, situation_matrimoniale = :situation_matrimoniale, id_statut = :id_statut, id_age = :id_age, statut_emploi = :statut_emploi WHERE matricule = :matricule";
           
           // Préparation de la requête
           $stmt = $this->connexion->prepare($sql);
           
           // Liaison des valeurs aux paramètres
           $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
           $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
           $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
           $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
           $stmt->bindParam(':situation_matrimoniale', $situationMatrimoniale, PDO::PARAM_STR);
           $stmt->bindParam(':id_statut', $id_statut, PDO::PARAM_INT);
           $stmt->bindParam(':id_age', $id_age, PDO::PARAM_INT);
           $stmt->bindParam(':statut_emploi', $statut_emploi, PDO::PARAM_STR);
           
           // Exécution de la requête
           $stmt->execute();
           
           // Redirection vers la page affichage.php après la mise à jour réussie
           header("Location: affichage.php");
           exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
       } catch(PDOException $e) {
           // Gestion de l'erreur en la lançant à l'extérieur de la méthode
           throw new Exception("ERREUR: Impossible de mettre à jour les données du membre. " . $e->getMessage());
       }
   }

   // Méthode pour supprimer un membre
public function supprimerMembre($matricule) {
   try {
       $requete = $this->connexion->prepare('DELETE FROM membre WHERE matricule = :matricule');
       $requete->bindValue(':matricule', $matricule);
       $requete->execute();
       echo "Le membre avec le matricule $matricule a été supprimé avec succès.";
   } catch(PDOException $e) {
       die('Erreur suppression : ' . $e->getMessage());
   }
}

}
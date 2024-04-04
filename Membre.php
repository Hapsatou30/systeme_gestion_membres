
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
    private $tranche_age;
    private $sexe;
    private $situationMatrimoniale;
    private $statut;

    //la methode construct
     public function __construct($connexion,$matricule,$nom,$prenom,$tranche_age,$sexe,$situationMatrimoniale,$statut)
     {
        $this->connexion=$connexion;
        $this->matricule=$matricule;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->tranche_age=$tranche_age;
        $this->sexe=$sexe;
        $this->situationMatrimoniale=$situationMatrimoniale;
        $this->statut=$statut;
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
        $this->nom=$nouveauNom;
     }
     public function getprenom()
     {
        return $this->prenom;
     }

     public function setPrenom($nouveauPrenom)
     {
        $this->prenom=$nouveauPrenom;
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

     //la methode pour ajouter un membre

    //la methode pour ajouter un membre
    public function ajoutMembre($matricule,$nom,$prenom,$tranche_age,$sexe,$situationMatrimoniale,$statut)
    {
        try {
            // Préparer et exécuter la requête d'insertion
            $requete = $this->connexion->prepare('INSERT INTO membre(matricule, nom, prenom, tranche_age, sexe, situation_matrimoniale, statut) VALUES (:matricule, :nom, :prenom, :tranche_age, :sexe, :situation_matrimoniale, :statut)');
            $requete->bindValue(':matricule', $matricule);
            $requete->bindValue(':nom', $nom);
            $requete->bindValue(':prenom', $prenom);
            $requete->bindValue(':tranche_age', $tranche_age);
            $requete->bindValue(':sexe', $sexe);
            $requete->bindValue(':situation_matrimoniale', $situationMatrimoniale);
            $requete->bindValue(':statut', $statut);
            $requete->execute();
            // Redirection vers la page index.php après la mise à jour réussie
        header("Location: affichage.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
        } catch(PDOException $e) {
            // Gérer l'erreur, par exemple, logguer l'erreur
            echo 'Erreur lors de l\'insertion : '.$e->getMessage();
        }
    }

     //la methode pour afficher les informations des membre
     public function lireMembre()
     {
        try {
            //la requette sql
            $sql="SELECT * FROM membre";

            //preparer la requette
            $stmt= $this->connexion->prepare($sql);

            //execute la requette 
            $stmt->execute();
            
            //recuperation des resultats dans un tableau
            $resultats = $stmt ->fetchAll(PDO::FETCH_ASSOC);

            return $resultats;
           
        } catch (PDOException $e) {
            //gestion des erreurs
            die("::ERREUR:: Impossible de d'afficher les détails des membre");
        }
        
     }

     
     public function modifierMembre($matricule, $nom, $prenom, $tranche_age, $sexe, $situationMatrimoniale, $statut)
{
    try {
        // Requête SQL de mise à jour avec des paramètres
        $sql = "UPDATE membre SET nom = :nom, prenom = :prenom, tranche_age = :tranche_age, sexe = :sexe, situation_matrimoniale = :situation_matrimoniale, statut = :statut WHERE matricule = :matricule";
        
        // Préparation de la requête
        $stmt = $this->connexion->prepare($sql);
        
        // Liaison des valeurs aux paramètres
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':tranche_age', $tranche_age, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $stmt->bindParam(':situation_matrimoniale', $situationMatrimoniale, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Redirection vers la page index.php après la mise à jour réussie
        header("Location: affichage.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } catch(PDOException $e) {
        // Gestion de l'erreur en la lançant à l'extérieur de la méthode
        throw new Exception("ERREUR: Impossible de mettre à jour les données de l'étudiant. " . $e->getMessage());
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
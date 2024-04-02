<?php
//require_once(__DIR__ .'/configue.php');
require_once(__DIR__.'/CRUD.php');
//creation de la classe Membre
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
         } catch(PDOException $e) {
             // Gérer l'erreur, par exemple, logguer l'erreur
             echo 'Erreur lors de l\'insertion : '.$e->getMessage();
         }
     }
     

     //la methode pour afficher les informations des membre
     public function lireMembre()
     {
        
     }

     
     //la methode pour modifier les information d'un membre
     public function modifierMembre()
     {
        
     }

     //la methode pour supprimer un membre
      public function supprimerMembre()
      {
        
      }
}
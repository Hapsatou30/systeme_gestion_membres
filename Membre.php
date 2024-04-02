<?php 
require_once "CRUD.php";
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

     public function ajoutMembre()
     {
        
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

     
     //la methode pour modifier les information d'un membre
     public function modifierMembre()
     {
        
     }

     //la methode pour supprimer un membre
      public function supprimerMembre()
      {
        
      }
}
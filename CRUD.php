<?php
interface CRUD 
{
    public function ajoutMembre($matricule, $nom, $prenom, $sexe, $situationMatrimoniale);
    public function lireMembre();
    // public function modifierMembre($matricule,$nom,$prenom,$tranche_age,$sexe,$situationMatrimoniale,$statut);
    // public function supprimerMembre($matricule);
}
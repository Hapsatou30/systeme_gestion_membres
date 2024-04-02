<?php
interface CRUD 
{
    public function ajoutMembre($matricule,$nom,$prenom,$tranche_age,$sexe,$situationMatrimoniale,$statut);
    public function lireMembre();
    public function modifierMembre();
    public function supprimerMembre($matricule);
}
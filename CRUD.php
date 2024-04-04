<?php
interface CRUD 
{
    public function ajoutMembre($matricule, $nom, $prenom, $sexe, $situationMatrimoniale, $id_statut, $id_age);
    public function lireMembre();
    public function modifierMembre($matricule,$nom,$prenom,$tranche_age,$sexe,$situationMatrimoniale,$statut);
    public function supprimerMembre($matricule);
}
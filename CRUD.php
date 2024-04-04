<?php
interface CRUD 
{
    public function ajoutMembre($matricule, $nom, $prenom, $sexe, $situation_matrimoniale, $id_statut, $id_age, $statut_emploi);
    public function lireMembre();
//      public function modifierMembre($matricule,$nom,$prenom,$tranche_age,$sexe,$situationMatrimoniale,$statut);
//      public function supprimerMembre($matricule);
}
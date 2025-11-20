<?php

namespace App\Repository;

use App\Entity\ProposeTrajetChauffeurs;

class ProposeTrajetChauffeursRepository extends Repository
{
    public function findAll() : array
    {
        $query = $this->pdo->prepare("SELECT * FROM propose_trajet_chauffeurs");
        $query->execute();

        $trajets_chauffeurs = $query->fetchAll($this->pdo::FETCH_ASSOC);

        return $trajets_chauffeurs;
    }
        

}

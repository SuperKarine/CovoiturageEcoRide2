<?php

namespace App\Entity;

class Aller
{
    /**
     * @var int $id_aller   Identifiant de Aller en auto incrément
     */
    private int $id_aller;

    /**
     * @var string $ville_aller
     */
    private string $ville_aller;

    /**
     * @var string $id_villes
     */
    private string $id_villes;
    


    public function __construct(
        int $id_aller,
        string $ville_aller,
        string $id_villes
    )
    {
        $this->id_aller = $id_aller;
        $this->ville_aller = $ville_aller;
        $this->id_villes = $id_villes;

    }


    /**
     * Récupère l'id de l'aller
     *
     * @return id_aller
     */
    public function getIdAller()
    {
        return $this->id_aller;
    }

    /**
     * Récupère la ville de l'aller
     *
     * @return ville_aller
     */
    public function getVilleAller()
    {
        return $this->ville_aller;
    }

    /**
     * Modifie la ville de l'aller
     *
     * @param string $ville_aller
     * @return ville_aller
     */
    public function setVilleAller($ville_aller)
    {
        $this->ville_aller = $ville_aller;

        return $this;
    }

    /**
     * Récupère l'id villes
     *
     * @return id_villes
     */
    public function getIdVilles()
    {
        return $this->id_villes;
    }

    
}
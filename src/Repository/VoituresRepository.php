<?php

namespace App\Repository;

use App\Entity\Voitures;

class VoituresRepository extends Repository
{
    /**
     * est un objet PDOStatement pour l'utilisation des méthodes PDO::query et PDO::prepare
     *
     * @var \PDOStatement
     */
    private $pdoStatement;

    public function __construct()
    {
        
    }

    public function create()
}
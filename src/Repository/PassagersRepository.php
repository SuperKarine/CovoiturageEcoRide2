<?php

namespace App\Repository;

use App\Entity\Passagers;

class PassagersRepository extends Repository
{
     /**
     * est un objet PDOStatement pour l'utilisation des méthodes PDO::query et PDO::prepare
     *
     * @var \PDOStatement
     */
    private $pdoStatement;

    /**
     * Insert un objet Passagers
     *
     * @param Passagers $passagers
     * @return void
     */
    public function create(Passagers $passagers)
    {

    }



}
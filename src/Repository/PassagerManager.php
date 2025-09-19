<?php

namespace App\Repository;

use App\Entity\Passagers;

class PassagerManager{
    public function create(Passagers $passagers)
    {
        //insertion de l'objet passé en argument
        // met à jour l'identifiant de l'objet
        // retourne TRUE OR FALSE

    }

    public function read($id)
    {
        //Récupération de l'objet ayant l'identifiant
        //$id passé en argument
        //retourne un objet Passagers ou NULL
    }

    public function readAll()
    {
        // récupération de tous les objets de la bdd
        // retourne un tableau d'objets Passagers ou un tableau vide
    }

    public function update(Passagers $passagers)
    {
        //mis à jour de l'objet passé en argument
        // retourne TRUE OR FALSE
    }

    public function delete(Passagers $passagers)
    {
        // suppression de l'objet passé en argument
        // retourne TRUE OR FALSE
    }
}
<?php

namespace App\Controller;

use App\Entity\Passagers;

Class PageController
{
    public function accueil(): void
    {
        echo "Page accueil";
    }

    public function apropos(): void
    {
        echo "Page apropos";
    }

    public function passagers(): void
    {
        $passager = new Passagers();
         //Stockage des objets en bdd


        $passager->set_date_trajet($_POST['date_trajet']) ?? '';

    }

    

}
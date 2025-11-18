<?php

namespace App\Controller;

use App\Controller\Controller;

class PageController extends Controller
{
    public function accueil(): void
    {
        $this->render('page/accueil');
    }

    public function apropos(): void
    {
        $this->render('page/apropos');
    }
    
    public function connexion(): void
    {
        $this->render('page/connexion');
    }

    public function inscription(): void
    {
        $this->render('page/inscription');
    }

    public function Propose_trajet_chauffeurs(): void
    {
        $this->render('page/Propose_trajet_chauffeurs');
    }

    public function reserver_trajet(): void
    {
        $this->render('page/reserver_trajet');
    }

    public function propose_trajet_passagers(): void
    {
        $this->render('page/propose_trajet_passagers');
    }






}
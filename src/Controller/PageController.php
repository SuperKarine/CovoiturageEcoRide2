<?php

namespace App\Controller;

use App\Controller\Controller;

use App\Repository\ProposeTrajetChauffeursRepository;

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

    public function villes(): void
    {
        $this->render('page/villes');
    }

    public function trajets(): void
    {
        $this->render('page/trajets');
    }

    public function read_voitures(): void
    {
        $this->render('page/read_voitures');
    }

    public function create_voitures(): void
    {
        $this->render('page/create_voitures');
    }

    public function covoiturage(): void
    {
        $this->render('page/covoiturage');
    }

    public function essaie_trajets(): void
{
    $proposeTrajetChauffeursRepository = new ProposeTrajetChauffeursRepository();
    $trajets_chauffeurs = $proposeTrajetChauffeursRepository->findAll();
    
    $this->render('page/essaie_trajets', [
        'trajets_chauffeurs' => $trajets_chauffeurs
    ]);
}


  






}
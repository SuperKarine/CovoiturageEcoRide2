<?php

namespace App\Controller;

Class PageController extends Controller
{
    public function accueil(): void
    {
        $this->render('page/accueil');
    }

    public function apropos(): void
    {
        $this->render('page/apropos');
    }

   







}
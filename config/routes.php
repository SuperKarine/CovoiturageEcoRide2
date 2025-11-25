<?php
return [
    "/apropos" => [
        "controller" => "App\Controller\PageController",
        "action" => "apropos"
    ],
    "/" => [
        "controller" => "App\Controller\PageController",
        "action" => "accueil"
    ],

    "/connexion" => [
        "controller" => "App\Controller\PageController",
        "action" => "connexion"
    ],

    "/inscription" => [
        "controller" => "App\Controller\PageController",
        "action" => "inscription"
    ],

    "/Propose_trajet_chauffeurs" => [
        "controller" => "App\Controller\PageController",
        "action" => "Propose_trajet_chauffeurs"
    ],

    "/propose_trajet_passagers" => [
        "controller" => "App\Controller\PageController",
        "action" => "propose_trajet_passagers"
    ],

    "/villes" => [
        "controller" => "App\Controller\PageController",
        "action" => "villes"
    ],

    "/trajets" => [
        "controller" => "App\Controller\PageController",
        "action" => "trajets"
    ],


    "/read_voitures" => [
        "controller" => "App\Controller\PageController",
        "action" => "read_voitures"
    ],

    "/create_voitures" => [
        "controller" => "App\Controller\PageController",
        "action" => "create_voitures"
    ],

    "/covoiturage" => [
        "controller" => "App\Controller\PageController",
        "action" => "covoiturage"
    ],

    "/essaie_trajets" => [
        "controller" => "App\Controller\PageController",
        "action" => "essaie_trajets"
    ],

    "/reserver_trajet" => [
        "controller" => "App\Controller\ReservationController",
        "action" => "reserverTrajet"
    ],

    "/traiter_reservation" => [
        "controller" => "App\Controller\ReservationController", 
        "action" => "traiterReservation"
    ],

    "/mes_reservations" => [
        "controller" => "App\Controller\ReservationController",
        "action" => "mesReservations"
    ],

    // Route GET pour afficher le formulaire unique
    '/register-recharge' => [
        'controller' => 'App\Controller\AuthController',
        'action' => 'showRegisterRecharge'
    ],

    // Route POST pour traiter l'inscription (utilisateurs non connectés)
    '/auth/register' => [
        'controller' => 'App\Controller\AuthController', 
        'action' => 'handleRegister'
    ],

    // Route POST pour traiter la recharge (utilisateurs connectés)
    '/auth/recharge' => [
        'controller' => 'App\Controller\AuthController',
        'action' => 'handleRecharge'
    ]

    

    




];
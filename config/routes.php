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

    "/reserver_trajet" => [
        "controller" => "App\Controller\PageController",
        "action" => "reserver_trajet"
    ],

    "/propose_trajet_passagers" => [
        "controller" => "App\Controller\PageController",
        "action" => "propose_trajet_passagers"
    ]




];
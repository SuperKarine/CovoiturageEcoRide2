<?php
// Charger l'autoload
require_once __DIR__ . "/../vendor/autoload.php";

// Je définis une constante pour avoir le chemin racine de l'app
define('APP_ROOT', dirname(__DIR__));
define('APP_ENV', ".env");

use App\Routing\Router;

// Démarrer la session
session_start();

$router = new Router();

// Routes pour les pages
$router->get('/', 'PageController@accueil');
$router->get('/propose_trajet_chauffeurs', 'PageController@propose_trajet_chauffeurs');
$router->get('/reserver_trajet', 'PageController@reserver_trajet');
$router->get('/propose_trajet_passagers', 'PageController@propose_trajet_passagers');
$router->get('/villes', 'PageController@villes');
$router->get('/trajets', 'PageController@trajets');
$router->get('/read_voitures', 'PageController@read_voitures');
$router->get('/create_voitures', 'PageController@create_voitures');
$router->get('/covoiturage', 'PageController@covoiturage');
$router->get('/essaie_trajets', 'PageController@essaie_trajets');

// Routes d'authentification (AuthController)
$router->get('/connexion', 'AuthController@showLogin');
$router->post('/connexion', 'AuthController@processLogin');
$router->get('/inscription', 'AuthController@showRegisterRecharge');
$router->post('/inscription', 'AuthController@processRegistration');
$router->post('/recharge', 'AuthController@processRecharge');
$router->post('/deconnexion', 'AuthController@logout');
$router->get('/mot-de-passe-oublie', 'AuthController@showForgotPassword');
$router->post('/mot-de-passe-oublie', 'AuthController@processForgotPassword');

// Routes des réservations
$router->get('/mes_reservations', 'ReservationController@mesReservations');
$router->post('/traiter_reservation', 'ReservationController@traiterReservation');

// Routes pour les chauffeurs
$router->get('/chauffeur/dashboard', 'ChauffeurController@showDashboard');
$router->get('/chauffeur/proposer-trajet', 'ChauffeurController@showProposerTrajet');
$router->post('/chauffeur/proposer-trajet', 'ChauffeurController@handleProposerTrajet');
$router->get('/trajets-disponibles', 'ChauffeurController@showTrajetsDisponibles');
$router->get('/trajet/{id}', 'ChauffeurController@showTrajetDetail');
$router->post('/chauffeur/supprimer-trajet', 'ChauffeurController@handleDeleteTrajet');
$router->post('/chauffeur/update-places', 'ChauffeurController@handleUpdatePlaces');

// Routes admin
$router->get('/admin/dashboard', 'AdminController@showDashboard');
$router->get('/admin/trajets', 'AdminController@showAllTrajets');
$router->get('/admin/trajet/{id}/edit', 'AdminController@showEditTrajet');
$router->post('/admin/trajet/edit', 'AdminController@handleEditTrajet');
$router->post('/admin/trajet/cancel', 'AdminController@handleCancelTrajet');

// L'admin peut aussi accéder aux routes chauffeur
$router->get('/chauffeur/dashboard', 'ChauffeurController@showDashboard');
$router->get('/chauffeur/proposer-trajet', 'ChauffeurController@showProposerTrajet');
$router->post('/chauffeur/proposer-trajet', 'ChauffeurController@handleProposerTrajet');

// L'admin peut accéder aux routes passager
$router->get('/passager/dashboard', 'PassagerController@showDashboard');
$router->get('/passager/reservations', 'PassagerController@showReservations');
$router->get('/passager/historique', 'PassagerController@showHistorique');
$router->get('/passager/profil', 'PassagerController@showProfil');
$router->post('/passager/reserver', 'PassagerController@createReservation');
$router->post('/passager/annuler-reservation', 'PassagerController@cancelReservation');
$router->post('/passager/recharger', 'PassagerController@rechargerCredits');


$router->handleRequest($_SERVER["REQUEST_URI"]);



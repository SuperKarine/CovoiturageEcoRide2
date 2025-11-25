<?php

namespace App\Controller;

use App\Repository\UtilisateursRepository;
use App\Repository\PassagersRepository;

class AuthController extends Controller
{
    private UtilisateursRepository $utilisateursRepository;
    private PassagersRepository $passagersRepository;

    public function __construct()
    {
        $this->utilisateursRepository = new UtilisateursRepository();
        $this->passagersRepository = new PassagersRepository();
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function showLogin(): void
    {
        // Si déjà connecté, rediriger vers l'accueil
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }
        
        $this->render('auth/connexion');
    }

    /**
     * Traite la connexion
     */
    public function handleLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /connexion?error=method');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validation basique
        if (empty($email) || empty($password)) {
            header('Location: /connexion?error=empty');
            exit;
        }

        // Recherche de l'utilisateur
        $user = $this->utilisateursRepository->getUserByEmail($email);
        
        // Vérification que l'utilisateur existe et que le mot de passe est correct
        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            header('Location: /connexion?error=invalid');
            exit;
        }

        // Connexion réussie
        $_SESSION['user_id'] = $user['id_utilisateurs'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_email'] = $user['email'];

        // AJOUT : Récupérer et stocker les crédits si c'est un passager
        $passager = $this->passagersRepository->findById($user['id_utilisateurs']);
        if ($passager) {
            $_SESSION['user_credits'] = $passager->getCreditRestant();
        }

        header('Location: /?success=login');
        exit;
    }

    /**
     * Déconnexion
     */
    public function logout(): void
    {
        session_destroy();
        header('Location: /?success=logout');
        exit;
    }

    /**
     * Vérifie si l'utilisateur est connecté 
     */
    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Redirige si non connecté 
     */
    public static function requireAuth(): void
    {
        if (!self::isLoggedIn()) {
            header('Location: /connexion?error=auth_required');
            exit;
        }
    }

    /**
     * Affiche le formulaire unique d'inscription/recharge
     * Route: GET /register-recharge
     */
    public function showRegisterRecharge(): void
    {
        // Le template gère automatiquement l'affichage selon l'état de connexion
        $this->render('auth/register_recharge');
    }

    /**
     * Traite l'inscription des nouveaux utilisateurs
     * Route: POST /auth/register
     */
    public function handleRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register-recharge?error=method');
            exit;
        }

        // Récupération des données
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $pseudo = trim($_POST['pseudo'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $date_naissance = $_POST['date_naissance'] ?? '1990-01-01';
        $telephone = $_POST['telephone'] ?? '';
        $montant_credit = intval($_POST['montant_credit'] ?? 0);

        // Validation des données
        if (empty($nom) || empty($prenom) || empty($pseudo) || !$email || empty($password) || empty($telephone)) {
            header('Location: /register-recharge?error=empty');
            exit;
        }

        if ($password !== $confirm_password) {
            header('Location: /register-recharge?error=password_mismatch');
            exit;
        }

        if (strlen($password) < 8) {
            header('Location: /register-recharge?error=password_short');
            exit;
        }

        // Vérifier si l'email existe déjà
        if ($this->utilisateursRepository->getUserByEmail($email)) {
            header('Location: /register-recharge?error=email_exists');
            exit;
        }

        // Calcul des crédits finaux (30 offerts + montant choisi)
        $credits_totaux = 30 + $montant_credit;

        // Création de l'utilisateur
        $success = $this->utilisateursRepository->createUtilisateur([
            'nom' => $nom,
            'prenom' => $prenom,
            'pseudo' => $pseudo,
            'email' => $email,
            'mot_de_passe' => password_hash($password, PASSWORD_DEFAULT),
            'date_naissance' => $date_naissance,
            'telephone' => $telephone,
            'isEmploye' => 0,
            'isPassager' => 1,
            'isChauffeur' => 0,
            'isPassagerChauffeur' => 0,
            'credit_en_cours' => $credits_totaux,
            'debit' => 0,
            'date_credit' => date('Y-m-d'),
            'date_debit' => date('Y-m-d')
        ]);

        if ($success) {
            // Redirection vers la page de connexion après inscription
            header('Location: /auth/login?success=registered');
        } else {
            header('Location: /register-recharge?error=creation_failed');
        }
        exit;
    }

    /**
     * Traite la recharge de crédits pour utilisateurs connectés
     * Route: POST /auth/recharge
     */
    public function handleRecharge(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register-recharge?error=method');
            exit;
        }

        // Vérifier que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth/login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $montant_credit = intval($_POST['montant_credit'] ?? 0);

        if ($montant_credit <= 0) {
            header('Location: /register-recharge?error=invalid_amount');
            exit;
        }

        // CORRECTION : Utilisez l'instance existante
        $success = $this->passagersRepository->rechargeCredits($user_id, $montant_credit);

        if ($success) {
            // Mettre à jour la session en récupérant le nouveau credit_restant
            $passager = $this->passagersRepository->findById($user_id);
            // AJOUT : Vérification que le passager existe
            if ($passager) {
                $_SESSION['user_credits'] = $passager->getCreditRestant();
            }
            header('Location: /register-recharge?success=recharged');
        } else {
            header('Location: /register-recharge?error=recharge_failed');
        }
        exit;
    }
}
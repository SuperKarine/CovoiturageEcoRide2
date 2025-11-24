<?php

namespace App\Controller;

use App\Repository\UtilisateursRepository;

class AuthController extends Controller
{
    private UtilisateursRepository $utilisateursRepository;

    public function __construct()
    {
        $this->utilisateursRepository = new UtilisateursRepository();
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
        
        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            header('Location: /connexion?error=invalid');
            exit;
        }

        // Connexion réussie
        $_SESSION['user_id'] = $user['id_utilisateurs'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_email'] = $user['email'];

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
}
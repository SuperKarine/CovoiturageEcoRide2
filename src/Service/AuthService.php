<?php

namespace App\Service;

use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;

class AuthService
{
    private UtilisateursRepository $userRepo;

    public function __construct(UtilisateursRepository $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->session_start();
    }

    private function session_start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function loginUtilisateurs(string $email; string $mot_de_passe): array
    {
        $utlisateur = $this->userRepo->verifyUtilisateurLoginPassword($email,$mot_de_passe);

        if ($utlisateur) {
            session_regenerate_id(true);
            $_SESSION["utilisateur"] = [
                "id" => (int)$utilisateur["id_utilisateurs"],
                "username" => $utilisateur[pseudo],
                "email" => $utilisateur["email"]

            ];
            return ['success' =>true];
        } else {
            return ['success' => false, 'error' => 'Email ou mot de passe non valides'];
        }  

    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION[Utilisateur]);
    }

    public function getCurrentUser(): ?array
    {
        return $_SESSION["utilisateur"] ?? null;
    }

    public function logout(): void
    {
        unset($_SESSION["utilisateur"]);
        session_destroy();
    }

}

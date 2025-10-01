<?php

namespace App\Repository;

use PDO;
use DateTime;

class UtilisateursRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

public function addUtilisateur(
    string $nom,
    string $prenom,
    string $pseudo,
    string $email,
    string $mot_de_passe,
    ?DateTime $date_naissance =null,
    ?string $telephone = null,
    bool $isEmploye = false,
    bool $isPassager = false,
    bool $isChauffeur = false,
    bool $isPassagerChauffeur = false,
    int $credits = 0,
    ?DateTime $date_credit = null,
    int $debit = 0,
    ?DateTime $date_debit = null,

):bool


    // requête pour ajouter un utilisateur

{
    $sql = "INSERT INTO utilisateurs (nom, prenom, pseudo, email, mot_de_passe, date_naissance, telephone, isEmploye, isPassager, isChauffeur, isPassagerChauffeur, credits, date_credit, debit, date_debit) VALUES (:nom, :prenom, :pseudo, :email, :mot_de_passe, :date_naissance, :telephone, :isEmploye, :isPassager, :isChauffeur, :isPassagerChauffeur, :credits, :date_credit, :debit, :date_debit)";

    $query = $this->pdo->prepare($sql);

    //Hash du mot de passe

    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    
    $query->bindValue(':nom',$nom);
    $query->bindValue(':prenom',$prenom);
    $query->bindValue(':pseudo',$pseudo);
    $query->bindValue(':email',$email);
    $query->bindValue(':mot_de_passe',$mot_de_passe_hash);
    $query->bindValue(':date_naissance',$date_naissance ? $date_naissance->format('Y-m-d') : null);
    $query->bindValue(':telephone',$telephone);
    $query->bindValue(':isEmploye',$isEmploye, PDO::PARAM_BOOL);
    $query->bindValue(':isPassager',$isPassager, PDO::PARAM_BOOL);
    $query->bindValue(':isChauffeur',$isChauffeur, PDO::PARAM_BOOL);
    $query->bindValue(':isPassagerChauffeur',$isPassagerChauffeur, PDO::PARAM_BOOL);
    $query->bindValue(':credits',$credits, PDO::PARAM_INT);
    $query->bindValue(':date_credit',$date_credit ? $date_credit->format('Y-m-d H:i:s') : null);
    $query->bindValue(':debit',$debit, PDO::PARAM_INT);
    $query->bindValue(':date_debit',$date_debit ? $date_debit->format('Y-m-d H:i:s') : null);
   
    return $query->execute();
}

// fonction pour vérifier l'utilisateur

public function verifyUtilisateur(array $utilisateur): array
{
    $errors= [];

    //Vérification nom

    if (isset($utilisateur["nom"])) {
        if (trim($utilisateur["nom"]) === "") {
            $errors["nom"] = "Le champ nom ne doit pas être vide";
        }
        
    } else {
        $errors["nom"] = "Il manque le champ nom";
    }

        //Vérification prénom

    if (isset($utilisateur["prenom"])) {
        if (trim($utilisateur["prenom"]) === "") {
            $errors["prenom"] = "Le champ prenom ne doit pas être vide";
        }
        
    } else {
        $errors["prenom"] = "Il manque le champ prénom";
    }

    // Vérification pseudo

    if (isset($utilisateur["pseudo"])) {
        if (trim($utilisateur["pseudo"]) === "") {
            $errors["pseudo"] = "Le champ pseudo ne doit pas être vide";
        } elseif (strlen($utilisateur["pseudo"]) < 3) {
            $errors["pseudo"] = "Le pseudo doit faire au moins 3 caractères";
        }
        
    } else {
        $errors["pseudo"] = "Il manque le champ pseudo";
    }

    // Vérification email

    if (isset($utilisateur["email"])) {
        if ($utilisateur["email"] === "") {
            $errors["email"] = "Le champ email ne doit pas être vide";
        } elseif (!filter_var($utilisateur["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Le format de l'email est invalide";
        }

    } else {
        $errors["email"] = "Il manque le champ email";
    }

    // Vérification mot de passe

    if (isset($utilisateur["mot_de_passe"])) {
        if ($utilisateur["mot_de_passe"] === "") {
            $errors["mot_de_passe"] = "Le champ mot de passe ne doit pas être vide";
        
        } elseif (strlen($utilisateur["mot_de_passe"]) < 8) {
            $errors["mot_de_passe"] = "Le mot de passe doit faire au moins 8 caractères";
        }

    } else {
        $errors["mot_de_passe"] = "Il manque le champ mot de passe";
    }
   
        return $errors;
    }
    
    public function verifyUtilisateurLoginPassword(string $email, string $mot_de_passe):bool|array
    {
        $query = $this->pdo->prepare("SELECT id_utilisateurs, nom, prenom, pseudo, email, mot_de_passe FROM utilisateurs WHERE email = :email");
        $query->bindValue(":email", $email);
        $query->execute();
        $utilisateur = $query->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur["mot_de_passe"])) {
            
            //Pas de retour sur le mot de passe sinon non sécurisé

            unset($utilisateur["mot_de_passe"]);
            return $utilisateur;

        } else {
            return false;
       }
    }

}
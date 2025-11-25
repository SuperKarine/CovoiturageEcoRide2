<?php

namespace App\Repository;

use App\Entity\Passagers;
use PDO;
use DateTime;

class PassagersRepository extends Repository
{
     /**
     * est un objet PDOStatement pour l'utilisation des méthodes PDO::query et PDO::prepare
     *
     * @var \PDOStatement
     */
    private $pdoStatement;

    /**
     * Récupère un passager par son ID
     */
    public function findById(int $id): ?Passagers
    {
        $sql = "SELECT * FROM passagers WHERE id_passagers = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) {
            return null;
        }

        return new Passagers(
            // Paramètres Utilisateurs
            $data['nom'],
            $data['prenom'],
            $data['pseudo'],
            $data['email'],
            '', // mot de passe non nécessaire pour la lecture
            new DateTime($data['date_naissance']),
            $data['telephone'],
            true,
            // Paramètres Passagers
            $data['id_passagers'],
            new DateTime($data['date_heure_trajet']),
            $data['nbre_places'],
            new DateTime($data['date_crédit_en_cours']),
            $data['credit_en_cours'],
            $data['debit'],
            new DateTime($data['date_debit']),
            $data['credit_restant']
        );
    }

    
    public function rechargeCredits(int $id, int $montant): bool
    {

        $sql = "UPDATE passagers 
            SET credit_en_cours = credit_en_cours + ?,
                credit_restant = (credit_en_cours + ?) - debit - 2,
                date_crédit_en_cours = NOW()
            WHERE id_passagers = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$montant, $montant, $id]);
}







}
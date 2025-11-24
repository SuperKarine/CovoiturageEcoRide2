<?php

namespace App\Repository;

use App\Entity\Utilisateurs;

use PDO;
use DateTime;



class UtilisateursRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM utilisateurs WHERE id_utilisateurs = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            return $data;
        }
        
        return null;
    }

    public function getUserByEmail($email)
{
    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    


}
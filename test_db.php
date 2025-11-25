<?php
// create_test_user.php - Script de création d'utilisateur test
require_once __DIR__ . "/vendor/autoload.php";

use App\Repository\UtilisateursRepository;

try {
    echo "Demarrage du script de creation d'utilisateur test...\n\n";

    $repository = new UtilisateursRepository();

    // Créer un utilisateur de test
    $testUser = [
        'prenom' => 'Test',
        'nom' => 'Utilisateur',
        'email' => 'test@example.com',
        'mot_de_passe' => password_hash('12345678', PASSWORD_DEFAULT)
    ];

    echo "Verification si l'utilisateur existe deja...\n";

    // Vérifier si l'utilisateur existe déjà
    $existingUser = $repository->getUserByEmail($testUser['email']);
    
    if (!$existingUser) {
        echo "Creation du nouvel utilisateur...\n";
        
        // Vérifie si la méthode createUtilisateur existe
        if (!method_exists($repository, 'createUtilisateur')) {
            echo "ERREUR : La methode createUtilisateur n'existe pas dans UtilisateursRepository\n";
            echo "Ajoutez cette methode dans votre classe UtilisateursRepository\n";
            exit;
        }
        
        $success = $repository->createUtilisateur($testUser);
        
        if ($success) {
            echo "SUCCES : Utilisateur de test cree !\n";
            echo "Email: test@example.com\n";
            echo "Mot de passe: 12345678\n";
            echo "Vous pouvez maintenant tester la connexion sur votre site.\n";
        } else {
            echo "ERREUR : Echec de la creation de l'utilisateur\n";
            echo "Verifiez que la table 'utilisateurs' existe dans votre base de donnees.\n";
        }
    } else {
        echo "L'utilisateur de test existe deja\n";
        echo "Email: test@example.com\n";
        echo "Mot de passe: 12345678\n";
        echo "Vous pouvez tester la connexion avec ces identifiants.\n";
    }

} catch (Exception $e) {
    echo "ERREUR CRITIQUE : " . $e->getMessage() . "\n";
    echo "Fichier: " . $e->getFile() . "\n";
    echo "Ligne: " . $e->getLine() . "\n";
}
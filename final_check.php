<?php
// final_check.php - Vérification finale SÉCURISÉE

// DÉFINIR LES CONSTANTES MANQUANTES - mêmes que dans votre index.php
define('APP_ROOT', __DIR__);
define('APP_ENV', '.env.cli');  // On utilise le fichier .env.cli

require_once __DIR__ . "/vendor/autoload.php";

use App\Repository\UtilisateursRepository;

try {
    echo "=== VÉRIFICATION FINALE SÉCURISÉE ===\n\n";

    $repository = new UtilisateursRepository();

    // 1. Test de connexion à la base
    echo "1. Test connexion base de données... ";
    $testConnection = $repository->getUserByEmail('test@example.com');
    echo "✅ OK\n";

    // 2. Vérification de l'utilisateur test
    echo "2. Statut utilisateur test... ";
    if ($testConnection) {
        echo "✅ EXISTE DÉJÀ\n";
        echo "   -> Email: test@example.com\n";
        echo "   -> Mot de passe: 12345678\n";
    } else {
        echo "❌ N'EXISTE PAS\n";
    }

    // 3. Vérification méthode createUtilisateur
    echo "3. Méthode createUtilisateur... ";
    if (method_exists($repository, 'createUtilisateur')) {
        echo "✅ PRÊTE\n";
    } else {
        echo "❌ MANQUANTE\n";
    }

    echo "\n=== RÉSUMÉ ===\n";
    if ($testConnection) {
        echo "🎯 Votre système est PRÊT !\n";
        echo "   L'utilisateur test existe déjà.\n";
        echo "   Vous pouvez tester la connexion immédiatement.\n";
    } else if (method_exists($repository, 'createUtilisateur')) {
        echo "🎯 PRÊT POUR CRÉATION :\n";
        echo "   L'utilisateur test n'existe pas encore.\n";
        echo "   Mais la méthode createUtilisateur est prête.\n";
    } else {
        echo "🎯 ACTION REQUISE :\n";
        echo "   La méthode createUtilisateur doit être ajoutée.\n";
    }

} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

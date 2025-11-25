<?php
// Script de diagnostic
echo "=== DIAGNOSTIC ===\n";

// 1. Vérifier APP_ROOT
define('APP_ROOT', dirname(__DIR__));
echo "1. APP_ROOT: " . APP_ROOT . "\n";

// 2. Vérifier vendor/autoload.php
$autoloadPath = __DIR__ . "/vendor/autoload.php";
echo "2. autoload.php existe: " . (file_exists($autoloadPath) ? "OUI" : "NON") . "\n";

if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
    echo "3. autoload.php charge avec succes\n";
    
    // 3. Vérifier la classe UtilisateursRepository
    if (class_exists('App\Repository\UtilisateursRepository')) {
        echo "4. UtilisateursRepository existe\n";
        
        // 4. Vérifier la méthode createUtilisateur
        $repository = new App\Repository\UtilisateursRepository();
        if (method_exists($repository, 'createUtilisateur')) {
            echo "5. createUtilisateur existe\n";
        } else {
            echo "5. createUtilisateur N'EXISTE PAS\n";
        }
    } else {
        echo "4. UtilisateursRepository N'EXISTE PAS\n";
    }
} else {
    echo "3. Impossible de charger autoload.php\n";
}

echo "=== FIN DIAGNOSTIC ===\n";

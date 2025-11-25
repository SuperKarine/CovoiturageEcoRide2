<?php 
require_once APP_ROOT . "/src/App/Db/Mysql.php";
require_once APP_ROOT . "/auth/session_check.php";

use App\Db\Mysql;

if ($_SESSION['user_type'] !== 'passager') {
    header('Location: ' . APP_ROOT . '/pages/accueil.php');
    exit;
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $montant = floatval($_POST['montant']);
    
    
    if ($montant <= 0) {
        $error = "Le montant doit être supérieur à 0";
    } else {
        try {
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();
            
            $pdo->beginTransaction();
            
            // Récupère l'id_passager de l'utilisateur
            $stmt = $pdo->prepare("SELECT id_passager FROM utilisateurs WHERE id_utilisateurs = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$utilisateur) {
                $error = "Utilisateur non trouvé";
                $pdo->rollBack();
            } else {
                $id_passager = $utilisateur['id_passager'];
                
                if (empty($id_passager)) {
                    // Créer un nouveau passager dans la table passagers
                    $stmt = $pdo->prepare("
                        INSERT INTO passagers (date_trajet, heure_trajet, nbre_places, date_crédit_en_cours, credit_en_cours, debit, date_debit, credit_restant) 
                        VALUES (CURDATE(), NOW(), 0, CURDATE(), ?, 0, CURDATE(), ?)
                    ");
                    $nouveau_credit = $montant;
                    $stmt->execute([$montant, $nouveau_credit]);
                    
                    $id_passager = $pdo->lastInsertId();
                    
                    // Mettre à jour l'utilisateur avec l'id_passager
                    $stmt = $pdo->prepare("UPDATE utilisateurs SET id_passager = ? WHERE id_utilisateurs = ?");
                    $stmt->execute([$id_passager, $_SESSION['user_id']]);
                    
                    $pdo->commit();
                    $success = "Votre compte passager a été créé et rechargé de {$montant}€ avec succès!";
                    $_SESSION['credits'] = $nouveau_credit;
                    
                } else {
                    // Récupère le crédit actuel du passager
                    $stmt = $pdo->prepare("SELECT credit_restant FROM passagers WHERE id_passagers = ?");
                    $stmt->execute([$id_passager]);
                    $passager = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if (!$passager) {
                        $error = "Profil passager non trouvé";
                        $pdo->rollBack();
                    } else {
                        $credit_actuel = $passager['credit_restant'] ?? 0;
                        $nouveau_credit = $credit_actuel + $montant;
                        
                        // Mettre à jour le crédit dans la table passagers
                        $stmt = $pdo->prepare("
                            UPDATE passagers 
                            SET credit_en_cours = ?, 
                                credit_restant = ?, 
                                date_crédit_en_cours = CURDATE() 
                            WHERE id_passagers = ?
                        ");
                        $stmt->execute([$montant, $nouveau_credit, $id_passager]);
                        
                        $pdo->commit();
                        $success = "Votre compte a été rechargé de {$montant}€ avec succès!";
                        $_SESSION['credits'] = $nouveau_credit;
                    }
                }
            }
            
        } catch (Exception $e) {
            if (isset($pdo)) {
                $pdo->rollBack();
            }
            $error = "Erreur lors de la recharge: " . $e->getMessage();
            error_log("Erreur recharge: " . $e->getMessage());
        }
    }
}

// Récupère le solde actuel via la jointure
try {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();
    
    $stmt = $pdo->prepare("
        SELECT p.credit_restant 
        FROM utilisateurs u 
        JOIN passagers p ON u.id_passager = p.id_passagers 
        WHERE u.id_utilisateurs = ?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $solde_actuel = $result['credit_restant'] ?? 0;
    } else {
        $solde_actuel = 0;
    }
} catch (Exception $e) {
    $error = "Erreur lors du chargement du solde: " . $e->getMessage();
    $solde_actuel = 0;
}
?>

<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2 class="h4 mb-0">Recharger mes crédits</h2>
                </div>
                <div class="card-body">
                    <!-- Affichage du solde actuel -->
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Solde actuel</h5>
                        <p class="mb-0 fs-4"><?= number_format($solde_actuel, 2) ?> €</p>
                    </div>
                    
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant de la recharge (€)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="5" max="500" 
                                       class="form-control" id="montant" name="montant" 
                                       placeholder="50.00" required>
                                <span class="input-group-text">€</span>
                            </div>
                            <div class="form-text">
                                Montant minimum: 5€, Maximum: 500€
                            </div>
                        </div>
                        
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Recharger mon compte</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <a href="<?= APP_ROOT ?>/auth/passagers.php" class="btn btn-outline-secondary">Retour au dashboard</a>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
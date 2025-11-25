<?php 
require_once APP_ROOT . "/src/App/Db/Mysql.php";
require_once APP_ROOT . "/auth/session_check.php";

use App\Db\Mysql;

if ($_SESSION['user_type'] !== 'passager') {
    header('Location: ' . APP_ROOT . '/pages/accueil.php');
    exit;
}

// Récupère le solde et les infos du passager
try {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();
    
    // Récupère le crédit via jointure utilisateurs-passagers
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
        $_SESSION['credits'] = $solde_actuel;
    } else {
        $solde_actuel = 0;
        
    }
    
    // Récupérer les réservations récentes
    $stmt = $pdo->prepare("
        SELECT 
            rt.*, 
            ptc.ville_depart, 
            ptc.ville_arrivee, 
            ptc.date_depart, 
            ptc.heure_depart,
            ptc.prix_personne,
            ptc.marque,
            ptc.modele
        FROM reserver_trajet rt 
        JOIN propose_trajet_chauffeurs ptc ON rt.num_trajet_reserve = ptc.num_trajet 
        WHERE rt.id_utilisateurs = ? 
        ORDER BY rt.date_reservation DESC 
        LIMIT 5
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    $error = "Erreur lors du chargement des données: " . $e->getMessage();
    error_log("Erreur dashboard: " . $e->getMessage());
    $solde_actuel = 0;
}
?>

<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<div class="container mt-4">
    <?php if (isset($_GET['welcome'])): ?>
        <div class="alert alert-success" role="alert">
            Bienvenue sur votre espace passager, <?= htmlspecialchars($_SESSION['prenom']) ?> !
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h1 class="h3 card-title">Bienvenue, <?= htmlspecialchars($_SESSION['prenom']) ?> !</h1>
                    <p class="card-text mb-0">Espace passager Ecoride</p>
                </div>
            </div>
            
            <!-- Carte de solde -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h2 class="h5 mb-0">Mon solde</h2>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3 class="text-success"><?= number_format($solde_actuel, 2) ?> €</h3>
                            <p class="text-muted">Solde disponible</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <?php if ($solde_actuel < 10): ?>
                                <div class="alert alert-warning mb-2">
                                    <small>Solde faible - Pensez à recharger</small>
                                </div>
                            <?php endif; ?>
                            <a href="<?= APP_ROOT ?>/auth/recharge_credits.php" class="btn btn-success">Recharger mon solde</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dernières réservations -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h2 class="h5 mb-0">Mes dernières réservations</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($reservations)): ?>
                        <div class="list-group">
                            <?php foreach ($reservations as $reservation): ?>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">
                                            <?= htmlspecialchars($reservation['ville_depart']) ?> → 
                                            <?= htmlspecialchars($reservation['ville_arrivee']) ?>
                                        </h5>
                                        <span class="badge bg-info">
                                            <?= $reservation['nbr_places'] ?> place(s)
                                        </span>
                                    </div>
                                    <p class="mb-1">
                                        Date: <?= $reservation['date_depart'] ?> à <?= $reservation['heure_depart'] ?>
                                    </p>
                                    <p class="mb-1">
                                        Véhicule: <?= htmlspecialchars($reservation['marque']) ?> <?= htmlspecialchars($reservation['modele']) ?>
                                    </p>
                                    <p class="mb-1">
                                        Prix total: <?= $reservation['prix_personne'] * $reservation['nbr_places'] ?> €
                                        (<?= $reservation['prix_personne'] ?> €/personne)
                                    </p>
                                    <small class="text-muted">
                                        Réservé le: <?= $reservation['date_reservation'] ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Vous n'avez pas encore de réservation. 
                            <a href="<?= APP_ROOT ?>/page_reserver_trajet" class="alert-link">Réservez votre premier trajet !</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="h5 mb-0">Actions rapides</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= APP_ROOT ?>/page_reserver_trajet" class="btn btn-primary">
                            Réserver un trajet
                        </a>
                        <a href="<?= APP_ROOT ?>/auth/recharge_credits.php" class="btn btn-outline-success">
                            Recharger mes crédits
                        </a>
                        <a href="<?= APP_ROOT ?>/page_propose_trajet_passagers" class="btn btn-outline-secondary">
                            Proposer un trajet
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Informations personnelles -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h4 class="h6 mb-0">Mes informations</h4>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Nom :</strong> <?= htmlspecialchars($_SESSION['nom']) ?></p>
                    <p class="mb-1"><strong>Prénom :</strong> <?= htmlspecialchars($_SESSION['prenom']) ?></p>
                    <p class="mb-1"><strong>Email :</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
                    <p class="mb-0"><strong>Type :</strong> Passager</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
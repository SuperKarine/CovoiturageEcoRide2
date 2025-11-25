<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>


<?php
session_start();
// état de connexion
$est_connecte = isset($_SESSION['user_id']);
$user_nom = $est_connecte ? $_SESSION['user_nom'] : '';
$user_credits = $est_connecte ? $_SESSION['user_credits'] : 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $est_connecte ? 'Rechargement de crédits' : 'Inscription & Recharge' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-credit-card me-2"></i>
                            <?= $est_connecte ? 'Recharger mes crédits' : 'Inscription & Recharge' ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <!-- Informations utilisateur connecté -->
                        <?php if ($est_connecte): ?>
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="bi bi-person-check me-2"></i>
                            <div>
                                <strong>Connecté en tant que :</strong> <?= htmlspecialchars($user_nom) ?><br>
                                <strong>Crédits actuels :</strong> <?= $user_credits ?> crédits
                            </div>
                        </div>
                        <?php endif; ?>

                        <form id="formulaire-unique" method="POST" action="traitement.php">
                            
                            <!-- Section Inscription (seulement si non connecté) -->
                            <?php if (!$est_connecte): ?>
                            <div class="mb-4">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="bi bi-person-plus me-2"></i>Informations personnelles
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nom" class="form-label">Nom *</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="prenom" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="telephone" class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control" id="telephone" name="telephone">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="motdepasse" class="form-label">Mot de passe *</label>
                                    <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Section Recharge de crédits (toujours visible) -->
                            <div class="mb-4">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="bi bi-wallet2 me-2"></i>Recharge de crédits
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="montant" class="form-label">Montant de la recharge *</label>
                                        <select class="form-select" id="montant" name="montant" required>
                                            <option value="">Choisir un montant</option>
                                            <option value="10">10 € - 100 crédits</option>
                                            <option value="20">20 € - 200 crédits</option>
                                            <option value="50">50 € - 500 crédits</option>
                                            <option value="100">100 € - 1200 crédits</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="moyen_paiement" class="form-label">Moyen de paiement *</label>
                                        <select class="form-select" id="moyen_paiement" name="moyen_paiement" required>
                                            <option value="">Choisir un moyen</option>
                                            <option value="carte">Carte bancaire</option>
                                            <option value="paypal">PayPal</option>
                                            <option value="virement">Virement bancaire</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Affichage dynamique du crédit calculé -->
                                <div class="alert alert-warning" id="credit-calcule">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span id="credit-text">Sélectionnez un montant pour voir les crédits obtenus</span>
                                </div>
                            </div>

                            <!-- Conditions générales (seulement si non connecté) -->
                            <?php if (!$est_connecte): ?>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="conditions" name="conditions" required>
                                <label class="form-check-label" for="conditions">
                                    J'accepte les conditions générales d'utilisation *
                                </label>
                            </div>
                            <?php endif; ?>

                            <!-- Bouton de soumission -->
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-check-circle me-2"></i>
                                <?= $est_connecte ? 'Recharger mes crédits' : 'S\'inscrire et Recharger' ?>
                            </button>

                            <!-- Lien de connexion pour les non connectés -->
                            <?php if (!$est_connecte): ?>
                            <div class="text-center mt-3">
                                <a href="login.php" class="text-decoration-none">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                    Déjà inscrit ? Se connecter
                                </a>
                            </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script pour calculer les crédits en temps réel -->
    <script>
        document.getElementById('montant').addEventListener('change', function() {
            const montant = this.value;
            const creditText = document.getElementById('credit-text');
            
            if (montant) {
                const credits = montant * 10; // 10 crédits par euro
                const bonus = montant >= 100 ? ' (+200 crédits bonus !)' : '';
                creditText.textContent = `${montant} € = ${credits} crédits${bonus}`;
            } else {
                creditText.textContent = 'Sélectionnez un montant pour voir les crédits obtenus';
            }
        });
    </script>
</body>
</html>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
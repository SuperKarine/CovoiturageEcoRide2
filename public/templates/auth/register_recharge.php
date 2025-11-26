<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<?php
session_start();
$est_connecte = isset($_SESSION['user_id']);
$user_nom = $est_connecte ? $_SESSION['user_nom'] : '';
$user_credits = $est_connecte ? $_SESSION['user_credits'] : 0;
?>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">
                            <?= $est_connecte ? 'Recharger mes crédits' : 'Inscription & Recharge' ?>
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Informations utilisateur connecté -->
                        <?php if ($est_connecte): ?>
                        <div class="alert alert-info mb-4">
                            <strong>Connecté en tant que :</strong> <?= htmlspecialchars($user_nom) ?><br>
                            <strong>Crédits actuels :</strong> <?= $user_credits ?> crédits
                        </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= $est_connecte ? '/auth/recharge' : '/auth/register' ?>">
                            
                            <!-- Section Inscription (seulement si non connecté) -->
                            <?php if (!$est_connecte): ?>
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Informations personnelles</h5>
                                
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
                                
                                <div class="mb-3">
                                    <label for="pseudo" class="form-label">Pseudo *</label>
                                    <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirmer le mot de passe *</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone *</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                                </div>

                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label">Date de naissance</label>
                                    <input type="date" class="form-control" id="date_naissance" name="date_naissance">
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Section Recharge de crédits -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Recharge de crédits</h5>
                                
                                <div class="mb-3">
                                    <label for="montant_credit" class="form-label">Montant de crédits à ajouter *</label>
                                    <select class="form-select" id="montant_credit" name="montant_credit" required>
                                        <option value="0">0 crédit (30 crédits offerts à l'inscription)</option>
                                        <option value="10">10 crédits</option>
                                        <option value="20">20 crédits</option>
                                        <option value="50">50 crédits</option>
                                        <option value="100">100 crédits</option>
                                    </select>
                                </div>
                                
                                <!-- Affichage du crédit total -->
                                <div class="alert alert-warning">
                                    <strong>Crédits totaux après recharge :</strong>
                                    <span id="credits-totaux">30 crédits (30 offerts + 0 choisis)</span>
                                </div>
                            </div>

                            <!-- Bouton de soumission -->
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                <?= $est_connecte ? 'Recharger mes crédits' : 'Créer mon compte et recharger' ?>
                            </button>

                            <!-- Lien de connexion pour les non connectés -->
                            <?php if (!$est_connecte): ?>
                            <div class="text-center">
                                <a href="/connexion" class="text-decoration-none">
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

    
</body>
</html>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
<?php require_once APP_ROOT . "/public/templates/layout/header.php"; ?>

<?php $this->extend('layout/default'); ?>

<?php $this->section('content'); ?>
<div class="container mt-4">
    <h1>Tableau de bord Passager</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php
            $messages = [
                'reservation_created' => 'Réservation créée avec succès',
                'reservation_cancelled' => 'Réservation annulée avec succès',
                'credits_recharged' => 'Crédits rechargés avec succès'
            ];
            echo $messages[$_GET['success']] ?? 'Opération réussie';
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php
            $messages = [
                'method' => 'Méthode non autorisée',
                'invalid_data' => 'Données invalides',
                'reservation_failed' => 'Échec de la réservation',
                'cancel_failed' => 'Échec de l\'annulation',
                'invalid_amount' => 'Montant invalide',
                'recharge_failed' => 'Échec de la recharge'
            ];
            echo $messages[$_GET['error']] ?? 'Une erreur est survenue';
            ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Trajets disponibles</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($trajetsDisponibles)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Départ</th>
                                        <th>Arrivée</th>
                                        <th>Date et heure</th>
                                        <th>Places</th>
                                        <th>Prix</th>
                                        <th>Chauffeur</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($trajetsDisponibles as $trajet): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($trajet->getVilleDepart()) ?></td>
                                            <td><?= htmlspecialchars($trajet->getVilleArrivee()) ?></td>
                                            <td><?= $trajet->getDateHeureDepart()->format('d/m/Y H:i') ?></td>
                                            <td><?= $trajet->getNbrPlaceRestantes() ?></td>
                                            <td><?= $trajet->getPrixPersonne() ?> €</td>
                                            <td><?= htmlspecialchars($trajet->getPseudoChauffeur()) ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="/trajet/<?= $trajet->getNumTrajet() ?>" class="btn btn-info">Voir</a>
                                                    <form method="POST" action="/passager/reserver" class="d-inline">
                                                        <input type="hidden" name="trajet_id" value="<?= $trajet->getNumTrajet() ?>">
                                                        <input type="number" name="nombre_places" value="1" min="1" max="<?= $trajet->getNbrPlaceRestantes() ?>" class="form-control form-control-sm d-inline" style="width: 70px;">
                                                        <button type="submit" class="btn btn-success">Réserver</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Aucun trajet disponible pour le moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Mon profil</h5>
                </div>
                <div class="card-body">
                    <?php if ($passager): ?>
                        <p><strong>Nom :</strong> <?= htmlspecialchars($passager->getNom()) ?></p>
                        <p><strong>Prénom :</strong> <?= htmlspecialchars($passager->getPrenom()) ?></p>
                        <p><strong>Email :</strong> <?= htmlspecialchars($passager->getEmail()) ?></p>
                        <p><strong>Crédits restants :</strong> <?= $passager->getCreditRestant() ?> €</p>
                    <?php else: ?>
                        <p class="text-muted">Aucune information de passager trouvée.</p>
                    <?php endif; ?>

                    <div class="mt-3">
                        <a href="/passager/reservations" class="btn btn-primary btn-sm">Mes réservations</a>
                        <a href="/passager/historique" class="btn btn-secondary btn-sm">Historique</a>
                        <a href="/passager/profil" class="btn btn-info btn-sm">Mon profil</a>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Recharger mes crédits</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/passager/recharger">
                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant (€)</label>
                            <input type="number" class="form-control" id="montant" name="montant" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Recharger</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>


















<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
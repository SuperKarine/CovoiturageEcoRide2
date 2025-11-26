<?php require_once APP_ROOT . "/public/templates/layout/header.php"; ?>


<?php $this->extend('layout/default'); ?>

<?php $this->section('content'); ?>
<div class="container mt-4">
    <h1>Tableau de bord Chauffeur</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php
            $messages = [
                'trajet_created' => 'Trajet créé avec succès',
                'trajet_deleted' => 'Trajet supprimé avec succès',
                'places_updated' => 'Places mises à jour avec succès'
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
                'invalid_id' => 'ID de trajet invalide',
                'not_owner' => 'Vous n\'êtes pas le propriétaire de ce trajet',
                'delete_failed' => 'Échec de la suppression',
                'update_failed' => 'Échec de la mise à jour'
            ];
            echo $messages[$_GET['error']] ?? 'Une erreur est survenue';
            ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Mes trajets</h5>
                    <a href="/chauffeur/proposer-trajet" class="btn btn-success btn-sm">Proposer un trajet</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($trajets)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Départ</th>
                                        <th>Arrivée</th>
                                        <th>Date et heure</th>
                                        <th>Places</th>
                                        <th>Prix</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($trajets as $trajet): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($trajet->getVilleDepart()) ?></td>
                                            <td><?= htmlspecialchars($trajet->getVilleArrivee()) ?></td>
                                            <td><?= $trajet->getDateHeureDepart()->format('d/m/Y H:i') ?></td>
                                            <td><?= $trajet->getNbrPlaceRestantes() ?>/<?= $trajet->getNbrPlaceTrajet() ?></td>
                                            <td><?= $trajet->getPrixPersonne() ?> €</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="/trajet/<?= $trajet->getNumTrajet() ?>" class="btn btn-info">Voir</a>
                                                    <form method="POST" action="/chauffeur/supprimer-trajet" class="d-inline">
                                                        <input type="hidden" name="trajet_id" value="<?= $trajet->getNumTrajet() ?>">
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Aucun trajet proposé pour le moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informations</h5>
                </div>
                <div class="card-body">
                    <?php if ($chauffeur): ?>
                        <p><strong>Nom :</strong> <?= htmlspecialchars($chauffeur->getNom()) ?></p>
                        <p><strong>Prénom :</strong> <?= htmlspecialchars($chauffeur->getPrenom()) ?></p>
                        <p><strong>Email :</strong> <?= htmlspecialchars($chauffeur->getEmail()) ?></p>
                        <p><strong>Véhicule :</strong> <?= htmlspecialchars($chauffeur->getMarque()) ?> <?= htmlspecialchars($chauffeur->getModele()) ?></p>
                    <?php else: ?>
                        <p class="text-muted">Aucune information de chauffeur trouvée.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>













<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>

<?php 
require_once APP_ROOT . "/public/templates/layout/header.php"; ?>


<main>
    <h2>Je propose un trajet<span class="badge bg-secondary"> Passagers</span></h2>
    <br>

    <h6>Numéro du trajet <span class="badge bg-secondary"><?=htmlspecialchars($num_trajet)?></span></h6>

    <!-- Affichage du trajet -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informations du trajet</h5>
            <p><strong>Ville départ :</strong> <?=htmlspecialchars($ville_depart)?></p>
            <p><strong>Ville arrivée :</strong> <?=htmlspecialchars($ville_arrivee)?></p>
            <p><strong>Date et heure de départ :</strong> <?=htmlspecialchars($date_depart)?></p>
            <p><strong>Places disponibles :</strong> <?=htmlspecialchars($nbr_place_trajet)?></p>
            <p><strong>Chauffeur :</strong> <?=htmlspecialchars($pseudo_chauffeur)?></p>
        </div>
    </div>

    <!-- Affichage des infos utilisateur  -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Vos informations de proposition trajet</h5>
            <p><strong>Passager :</strong> <?=htmlspecialchars($user_prenom)?> <?=htmlspecialchars($user_nom)?></p>
            <p><strong>Email :</strong> <?=htmlspecialchars($user_email)?></p>
        </div>
    </div>

    <!-- Formulaire de réservation -->
    <form class="row g-3" method="POST" action="/traitement_propose_trajet_passagers.php">
        <input type="hidden" name="num_trajet" value="<?=$num_trajet?>">
        
        <div class="col-md-6">
            <label for="inputNbrPlaces" class="form-label">Nombre de places à réserver *</label>
            <input type="number" class="form-control" id="inputNbrPlaces" name="nbr_places" 
                   value="<?=$nbr_place_trajet?>">
        </div>

        <div class="col-md-6">
            <label for="inputDateDepart" class="form-label">Date du départ</label>
            <input type="date" class="form-control" id="inputDateDepart" name="date_depart" 
                   value="<?=$date_depart?>">
        </div>

        <div class="col-md-6">
            <label for="inputHeureDepart" class="form-label">Heure du départ</label>
            <input type="date" class="form-control" id="inputHeureDepart" name="heure_depart" 
                   value="<?=$heure_depart?>">
        </div>

        <div class="col-md-6">
            <label for="inputMessage" class="form-label">Message au chauffeur</label>
            <textarea class="form-control" id="inputMessage" name="message" rows="3"></textarea>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success me-2">
                ✅ Confirmer la proposition
            </button>
            <a href="/liste_trajets" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</main>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
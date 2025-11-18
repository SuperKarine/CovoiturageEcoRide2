<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<main>
    <h2>Voici les trajets que proposent nos chauffeurs<span class="badge bg-secondary"> Trajets chauffeurs</span></h2>
    <br><br>

   
    <div class="trajet-card"> 
    
        <h6>Numéro du trajet <span class="badge bg-secondary"><?=$num_trajet?></span></h6>

        <div class="row g-3">
            <!-- Remplacement des inputs par des champs en lecture seule -->
            <div class="col-md-6">
                <label class="form-label">Ville Départ</label>
                <div class="form-control-plaintext border bg-light p-2"><?=htmlspecialchars($ville_depart)?></div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Ville Arrivée</label>
                <div class="form-control-plaintext border bg-light p-2"><?=htmlspecialchars($ville_arrivee)?></div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date et heure de départ</label>
                <div class="form-control-plaintext border bg-light p-2"><?=htmlspecialchars($date_depart)?></div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date et heure d'arrivée</label>
                <div class="form-control-plaintext border bg-light p-2"><?=htmlspecialchars($date_arrivee)?></div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tarif</label>
                <div class="form-control-plaintext border bg-light p-2"><?=htmlspecialchars($prix_personne)?> €</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nombre de places restantes</label>
                <div class="form-control-plaintext border bg-light p-2"><?=htmlspecialchars($nbr_place_trajet)?></div>
            </div>

            <div class="col-12">
                <!-- Lien vers le formulaire d'inscription -->
                <a class="btn btn-primary" href="/reserver_trajet?id=<?=$num_trajet?>" role="button">
                    S'inscrire sur ce trajet
                </a>
            </div>
        </div>

        <!-- Informations complémentaires -->
        <div class="modal-body mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 ms-auto">Pseudo Chauffeur : <?=htmlspecialchars($Pseudo_chauffeur)?></div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        Marque de véhicule: <?=htmlspecialchars($marque)?>
                        <div class="row">
                            <div class="col-8 col-sm-6">
                                Modèle du véhicule: <?=htmlspecialchars($modele)?>
                            </div>
                            <div class="col-4 col-sm-6">
                                Temps trajet: <?=htmlspecialchars($temps_trajet)?>
                            </div>
                            <div class="col-4 col-sm-6">
                                Information sup.: <?=htmlspecialchars($information_sup)?>
                            </div>
                            <div class="col-8 col-sm-6">
                                Voyage écologique: <?=htmlspecialchars($voyage_ecologique)?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> 

</main>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
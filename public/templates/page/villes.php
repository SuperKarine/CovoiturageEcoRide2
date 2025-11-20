<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<main>
    <h2>Voici les villes que nous desservons <span class="badge bg-secondary"> Les villes de nos trajets</span></h2>
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
        
    </div> 

</main>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
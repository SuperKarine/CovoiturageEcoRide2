<?php 
require_once APP_ROOT . "/public/templates/layout/header.php"; ?>


<main>

    <?php=$gretting?> .<?php=$name?> 

    <h3>Voici nos trajets et nos villes<span class="badge bg-secondary"> Nos trajets/nos villes</span></h3>
    <br>

    <a href="/page_trajets" class="link-primary">voir les trajets</a>
    <a href="/page_villes" class="link-primary">Nos villes</a>

    <h3>Vous pouvez voir les trajets de nos chauffeurs<span class="badge bg-secondary"> Nos trajets</span></h3>
    <br>

    <a href="/page_propose_trajet_chauffeurs" class="link-primary">voir les trajets de nos chauffeurs</a>

    <h3>Vous pouvez réserver un trajet<span class="badge bg-secondary"> Réserver trajets</span></h3>
    <br>

    <a href="/page_reserver_trajet" class="link-primary">Réserver un trajet</a>

    <h3>Vous pouvez proposer un trajet<span class="badge bg-secondary"> Proposer un trajet</span></h3>
    <br>

    <a href="/page_propose_trajet_passagers" class="link-primary">Proposer un trajet</a>

    <h3>Charger vos crédits sur la page d'inscription<span class="badge bg-secondary"> Charger vos crédits</span></h3>
    <br>

    <a href="/page_inscription" class="link-primary">Charger vos crédits</a>





    

   
        
</main>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
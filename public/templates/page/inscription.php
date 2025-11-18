<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<main>

<div class="container py-3">
        <form action="" class="row g-3"> 

            <div class="col-md-6">
               <label class="form-label" for="name">Nom</label> 
               <input class="form-control" type="text" name="name" id="name">
            </div>

            <div class="col-md-6">
                <label class="form-label" for="prenom">Prénom</label> 
                <input class="form-control" type="text" name="prenom" id="prenom">
             </div>

             <div class="col-md-6">
                <label class="form-label" for="pseudo">Pseudo</label> 
                <input class="form-control" type="text" name="pseudo" id="pseudo">
             </div>

            <div class="col-md-6">
                <label class="form-label" for="email">Email</label> 
                <input class="form-control" type="email" name="email" id="email">
             </div>

             <div class="col-md-12">
                <label class="form-label" for="password">Mot de passe</label> 
                <input class="form-control" type="password" name="password" id="password">
             </div>

        

             <p class="form-text mt-5">Vous souhaitez vous inscrire, nous vous informons que pour vous déplacer il faut charger votre compte en crédit. Vous disposez de 30 crédits à l'inscription. Pour recharger votre compte vous devez vous réinscrire sur ce formulaire. A la fin de la saisie de ce formulaire, vous pourrez vous connecter sur la page connexion qui vous permettra de naviguer vers différentes pages ainsi que votre espace personnalisé pour le suivi de vos trajets ainsi que vos crédits en cours.</p>

             <div class="form-text mt-5 mb-3">Souhaitez-vous augmentez votre crédit ?</div>

    

              <div class="col-md-3 form-check">
                <input type="checkbox" class="form-check-input" id="oui">
                <label class="form-check-label" for="oui">Oui</label>
              </div>

              <div class="col-md-3 form-check">
                <input type="checkbox" class="form-check-input" id="non">
                <label class="form-check-label" for="non">Non</label>
              </div>

              <select class="form-select" aria-label="Default select example">
                <option selected>Sélectionner votre montant</option>
                <option value="90">90</option>
                <option value="120">120</option>
                <option value="130">130</option>
              </select>

              <div id="confirmation_credit" class="form-text mt-5 mb-3">Validez-vous votre choix ?</div>

              <div class="col-md-3 form-check">
                <input type="checkbox" class="form-check-input" id="oui">
                <label class="form-check-label" for="oui">Oui</label>
              </div>

              <div class="col-md-3 form-check">
                <input type="checkbox" class="form-check-input" id="non">
                <label class="form-check-label" for="non">Non</label>
              </div>


              <div class="col-md-12">
                <button class="btn btn-primary" type="submit">Envoyer</button>
              </div>

              <p class="form-text mt-5">Souhaitez-vous vous connecter ?</p>

              <div class="col-md-12">
                <a href="/connexion" class="btn btn-primary" type="submit">Connexion</a>
              </div>
 
            

        </form>

       

    </div>

    <?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
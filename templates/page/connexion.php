<?php require_once APP_ROOT . "/public/templates/header.php" ?>

<div class="container py-3">
        <form action="" class="row g-3">
            <div class="mb-3">
               <label class="form-label"  for="pseudo">Pseudo</label> 
               <input class="form-control"  type="text" name="pseudo" id="pseudo">
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label> 
                <input class="form-control" type="email" name="email" id="email">
             </div>

             <div class="col-md-12">
                <label class="form-label" for="password">Mot de passe</label> 
                <input class="form-control" type="password" name="password" id="password">
             </div>

             <div class="col-md-12">
                <button class="btn btn-primary"    type="submit">Envoyer</button>
              </div>
            
        </form>

    </div>
    













<?php require_once APP_ROOT . "/public/templates/footer.php" ?>

<?php require_once APP_ROOT . "/templates/page/header.php" ?>






<h1>A propos</h1>

    <div class="container py-3">
        <form action="" class="row g-3">
            <div class="mb-3">
               <label class="form-label"  for="name">Nom</label> 
               <input class="form-control form-control-lg"  type="text" name="name" id="name">
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label> 
                <input class="form-control" type="email" name="email" id="email">
             </div>

             <div id="formulaire_contact" class="form-text mt-5 mb-3">Etes-vous sastifait de votre trajet ?</div>

             <div class="col-md-3 form-check">
                <input type="checkbox" class="form-check-input" id="oui">
                <label class="form-check-label" for="oui">Oui</label>
              </div>

              <div class="col-md-3 form-check">
                <input type="checkbox" class="form-check-input" id="non">
                <label class="form-check-label" for="non">Non</label>
              </div>


             <div>
                <label class="form-label" for="message">Message</label> 
                <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
             </div>

             <div class="col-md-12">
                <button class="btn btn-primary"    type="submit">Envoyer</button>
              </div>
 
        </form>

    </div>


<?php require_once APP_ROOT . "/templates/page/footer.php" ?>

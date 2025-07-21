<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage EcoRide Hauts-de-France</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <h1>Accueil <?= $name ?? '' ?></h1>

  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
          <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>

          </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="/" class="nav-link">Accueil</a>
                </li>

                <li class="nav-item">
                  <a href="/covoiturage" class="nav-link">Covoiturage</a>
                </li>

                <li class="nav-item">
                  <a href="/espace" class="nav-link">Espace</a>
                </li>

                <li class="nav-item">
                  <a href="/apropos" class="nav-link">Apropos</a>
                </li>

                <li class="nav-item">
                  <a href="/connexion" class="nav-link">Connexion</a>
                </li>

                <li class="nav-item">
                  <a href="/contact" class="nav-link">Contact</a>
                </li>

                <li class="nav-item">
                  <a href="rechercher" class="nav-link">Rechercher</a>
                </li>

                <li class="nav-item">
                  <a href="deconnexion" class="nav-link">Déconnexion</a>
                </li>
                  
            </ul>

        </div>
      </div>
    </nav>

    

  </header>
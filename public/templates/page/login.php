<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<h1>Se connecter</h1>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?php
        $error = $_GET['error'];
        if ($error == 'empty') {
            echo "Tous les champs sont obligatoires";
        } else if ($error == 'invalid') {
            echo "Email ou mot de passe incorrect";
        } else if ($error == 'auth_required') {
            echo "Veuillez vous connecter pour accéder à cette page";
        } else {
            echo "Erreur de connexion";
        }
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php
        $success = $_GET['success'];
        if ($success == 'login') {
            echo "Connexion réussie !";
        } else if ($success == 'logout') {
            echo "Déconnexion réussie";
        }
        ?>
    </div>
<?php endif; ?>

<form action="/login" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email *</label>
        <input type="email" class="form-control" id="email" name="email" 
               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
               placeholder="name@example.com" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe *</label>
        <input type="password" class="form-control" id="password" name="password" 
               placeholder="Votre mot de passe" required>
    </div>

    <p><strong>* = champs obligatoire</strong></p>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Se connecter</button>
    </div>

    <div class="mt-3">
        <a href="/inscription">Vous n'êtes pas inscrit ?</a>
    </div>
</form>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
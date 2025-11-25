<?php
session_start();
require_once __DIR__ . '/../src/App/Db/MongoDB.php';

use App\Db\MongoDB;

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['user_type'])) {
    switch($_SESSION['user_type']) {
        case 'admin':
            header('Location: admin_dashboard.php');
            break;
        case 'chauffeur':
            header('Location: chauffeur_dashboard.php');
            break;
        case 'passager':
            header('Location: passager_dashboard.php');
            break;
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        $mongo = MongoDB::getInstance();
        $collection = $mongo->getCollection('utilisateurs');
        
        $user = $collection->findOne(['email' => $email]);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = (string)$user['_id'];
            $_SESSION['user_type'] = $user['type'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            
            switch($user['type']) {
                case 'admin':
                    header('Location: admin_dashboard.php');
                    break;
                case 'chauffeur':
                    header('Location: chauffeur_dashboard.php');
                    break;
                case 'passager':
                    header('Location: passager_dashboard.php');
                    break;
            }
            exit;
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    } catch (Exception $e) {
        $error = "Erreur de connexion à la base de données";
        error_log("Login error: " . $e->getMessage());
    }
}
?>
<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center text-primary mb-4">Connexion à Ecoride</h2>
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success" role="alert">
                                Inscription réussie! Vous pouvez vous connecter.
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
                                       required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mb-3">Se connecter</button>
                        </form>
                        
                        <div class="text-center">
                            <a href="register.php" class="text-decoration-none">Créer un compte</a> • 
                            <a href="index.php" class="text-decoration-none">Retour à l'accueil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
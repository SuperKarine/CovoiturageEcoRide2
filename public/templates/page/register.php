<?php
session_start();
require_once APP_ROOT . "/src/App/Db/Mysql.php";

use App\Db\Mysql;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $type = $_POST['type'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    
    if ($password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas";
    } elseif (strlen($password) < 6) {
        $error = "Le mot de passe doit faire au moins 6 caractères";
    } else {
        try {
            // Connexion à MySQL 
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();
            
            // Vérifie si l'email existe déjà
            $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
            $stmt->execute([$email]);
            $existingUser = $stmt->fetch();
            
            if ($existingUser) {
                $error = "Cet email est déjà utilisé";
            } else {
                // Insère le nouvel utilisateur
                $stmt = $pdo->prepare("
                    INSERT INTO utilisateurs (email, password, type, nom, prenom, telephone, date_inscription, statut, credits) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW(), 'actif', ?)
                ");
                
                $credits = $type === 'passager' ? 0 : NULL;
                $stmt->execute([
                    $email, 
                    password_hash($password, PASSWORD_DEFAULT), 
                    $type, 
                    $nom, 
                    $prenom, 
                    $telephone, 
                    $credits
                ]);
                
                $user_id = $pdo->lastInsertId();
                
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_type'] = $type;
                $_SESSION['email'] = $email;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['credits'] = $credits;
                
                header('Location: ' . APP_ROOT . '/auth/' . ($type === 'chauffeur' ? 'chauffeur_dashboard.php' : 'passager_dashboard.php') . '?welcome=1');
                exit;
            }
        } catch (Exception $e) {
            $error = "Erreur lors de l'inscription: " . $e->getMessage();
            error_log("Registration error: " . $e->getMessage());
        }
    }
}
?>

<?php require_once APP_ROOT . "/public/templates/layout/header.php" ?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="card-title text-center text-primary mb-4">Inscription à Ecoride</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" 
                                           value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>" 
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" 
                                           value="<?= isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '' ?>" 
                                           required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" 
                                   value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe (min. 6 caractères)</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Type de compte</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Choisir le type de compte</option>
                                <option value="passager" <?= isset($_POST['type']) && $_POST['type'] === 'passager' ? 'selected' : '' ?>>Passager</option>
                                <option value="chauffeur" <?= isset($_POST['type']) && $_POST['type'] === 'chauffeur' ? 'selected' : '' ?>>Chauffeur</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-3">S'inscrire</button>
                    </form>
                    
                    <div class="text-center">
                        <a href="<?= APP_ROOT ?>/pages/login.php" class="text-decoration-none">Déjà un compte ? Se connecter</a> • 
                        <a href="<?= APP_ROOT ?>/pages/index.php" class="text-decoration-none">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . "/public/templates/layout/footer.php" ?>
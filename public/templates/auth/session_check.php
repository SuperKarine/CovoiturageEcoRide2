<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . APP_ROOT . '/pages/login.php');
    exit;
}

// Vérification des accès par rôle
$current_page = basename($_SERVER['PHP_SELF']);
$user_type = $_SESSION['user_type'];

// Pages accessibles par rôle
$allowed_pages = [
    'admin' => ['admin_dashboard.php', 'gestion_trajets.php', 'gestion_vehicules.php', 'gestion_utilisateurs.php'],
    'chauffeur' => ['chauffeur_dashboard.php', 'propose_trajet.php', 'mes_trajets.php'],
    'passager' => ['passager_dashboard.php', 'reservation_trajets.php', 'recharge_credits.php', 'mes_reservations.php']
];

// Vérifier si l'utilisateur a accès à la page actuelle
if (isset($allowed_pages[$user_type]) && !in_array($current_page, $allowed_pages[$user_type])) {
    // Rediriger vers le dashboard correspondant
    header('Location: ' . APP_ROOT . '/auth/' . $user_type . '_dashboard.php');
    exit;
}
?>
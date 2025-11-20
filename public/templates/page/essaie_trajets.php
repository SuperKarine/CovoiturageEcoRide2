<!DOCTYPE html>
<html>
<head>
    <title>À propos - EcoRide</title>
</head>
<body>
    <h1>À propos de EcoRide</h1>
    
    <h2>Nos trajets disponibles</h2>
    
    <?php if (isset($trajets_chauffeurs) && !empty($trajets_chauffeurs)): ?>
        <p>Nous avons <?php echo count($trajets_chauffeurs); ?> trajets disponibles :</p>
        
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Départ</th>
                    <th>Destination</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Chauffeur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trajets_chauffeurs as $trajet): ?>
                <tr>
                    <td><?php echo htmlspecialchars($trajet['ville_depart']); ?></td>
                    <td><?php echo htmlspecialchars($trajet['ville_arrivee']); ?></td>
                    <td><?php echo htmlspecialchars($trajet['prix_personne']); ?>€</td>
                    <td><?php echo htmlspecialchars($trajet['date_depart']); ?></td>
                    <td><?php echo htmlspecialchars($trajet['heure_depart']); ?></td>
                    <td><?php echo htmlspecialchars($trajet['pseudo_chauffeur']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun trajet disponible pour le moment.</p>
    <?php endif; ?>
</body>
</html>
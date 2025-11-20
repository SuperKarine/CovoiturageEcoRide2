<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

echo "🧪 Test MongoDB avec méthode fonctionnelle\n";
echo "==========================================\n";

$username = getenv('MONGO_INITDB_ROOT_USERNAME');
$password = getenv('MONGO_INITDB_ROOT_PASSWORD');

echo "Username: " . ($username ?: 'non défini') . "\n";
echo "Password: " . ($password ? '***' . substr($password, -3) : 'non défini') . "\n";

// URI MongoDB
$uri = "mongodb://$username:$password@mongo:27017";

try {
    $client = new Client($uri);
    
    // Test connexion
    $databases = $client->listDatabases();
    echo "✅ Connexion MongoDB réussie!\n";
    
    // Test opérations
    $db = $client->ecoride_mongo;
    $collection = $db->vehicules;
    
    // Insertion test
    $result = $collection->insertOne([
        'test' => true,
        'message' => 'Test avec ancienne méthode CLI',
        'timestamp' => new MongoDB\BSON\UTCDateTime()
    ]);
    
    echo "✅ Insertion réussie - ID: " . $result->getInsertedId() . "\n";
    
    // Lecture
    $doc = $collection->findOne(['_id' => $result->getInsertedId()]);
    echo "✅ Lecture réussie - Message: " . $doc['message'] . "\n";
    
    // Nettoyage
    $collection->deleteOne(['_id' => $result->getInsertedId()]);
    echo "✅ Nettoyage réussi\n";
    
    echo "🎉 Tous les tests passés avec succès!\n";
    
} catch (Exception $e) {
    echo "❌ Erreur MongoDB: " . $e->getMessage() . "\n";
    exit(1);
}

<?php
namespace App\Db;

class MongoDB
{
    private static ?self $_instance = null;
    private ?\MongoDB\Client $client = null;

    private function __construct()
    {
        
        $username = getenv('MONGO_INITDB_ROOT_USERNAME');
        $password = getenv('MONGO_INITDB_ROOT_PASSWORD');
        $host = getenv('MONGO_DB_HOST') ?: 'mongo';
        $port = getenv('MONGO_DB_PORT') ?: '27017';
        $dbName = getenv('MONGO_DB_NAME') ?: 'ecoride_mongo';

        try {
            
            $uri = "mongodb://{$username}:{$password}@{$host}:{$port}";
            $this->client = new \MongoDB\Client($uri);
            
            // Test de connexion
            $this->client->listDatabases();
            
        } catch (\Exception $e) {
            throw new \Exception("Erreur MongoDB: " . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getClient(): \MongoDB\Client
    {
        return $this->client;
    }

    public function getDatabase(): \MongoDB\Database
    {
        $dbName = getenv('MONGO_DB_NAME') ?: 'ecoride_mongo';
        return $this->client->selectDatabase($dbName);
    }

    public function getCollection(string $collectionName): \MongoDB\Collection
    {
        return $this->getDatabase()->selectCollection($collectionName);
    }
}
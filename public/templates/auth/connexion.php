<?php
namespace App\Db;

use PDO;
use PDOException;
use Exception;

class Mysql
{
    private string $dbName;
    private string $dbUser;
    private string $dbPassword;
    private string $dbPort;
    private string $dbHost;

    private ?PDO $pdo = null;
    private static ?self $_instance = null;

    private function __construct()
    {
        // Vérifier si le fichier de configuration existe
        if (!file_exists(APP_ROOT . "/" . APP_ENV)) {
            throw new Exception("Fichier de configuration de base de données introuvable: " . APP_ROOT . "/" . APP_ENV);
        }

        $dbConf = parse_ini_file(APP_ROOT . "/" . APP_ENV);

        // Vérifier que toutes les clés nécessaires existent
        $requiredKeys = ["db_host", "db_user", "db_password", "db_port", "db_name"];
        foreach ($requiredKeys as $key) {
            if (!isset($dbConf[$key])) {
                throw new Exception("Clé de configuration manquante: " . $key);
            }
        }

        $this->dbHost = $dbConf["db_host"];
        $this->dbUser = $dbConf["db_user"];
        $this->dbPassword = $dbConf["db_password"];
        $this->dbPort = $dbConf["db_port"];
        $this->dbName = $dbConf["db_name"];
    }

    public static function getInstance(): self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Mysql();
        }

        return self::$_instance;
    }

    public function getPDO(): PDO
    {
        if (is_null($this->pdo)) {
            try {
                $dsn = "mysql:dbname={$this->dbName};charset=utf8;host={$this->dbHost};port={$this->dbPort}";
                
                $this->pdo = new PDO(
                    $dsn,
                    $this->dbUser, 
                    $this->dbPassword,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::ATTR_PERSISTENT => false
                    ]
                );

            } catch (PDOException $e) {
                error_log("Erreur de connexion PDO: " . $e->getMessage());
                throw new Exception("Impossible de se connecter à la base de données. Vérifiez vos paramètres de connexion.");
            }
        }
        return $this->pdo;
    }

    /**
     * Teste la connexion à la base de données
     */
    public function testConnection(): bool
    {
        try {
            $pdo = $this->getPDO();
            $pdo->query("SELECT 1");
            return true;
        } catch (Exception $e) {
            error_log("Test de connexion échoué: " . $e->getMessage());
            return false;
        }
    }
}
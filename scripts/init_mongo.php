<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client;
$ecoride_mongo = $client->ecoride_mongo;

// Je crée une collection pour mes données
$vehiculeCollection= $ecoride_mongo->createCollection('vehicule');
var_dump($vehiculeCollection);


?>


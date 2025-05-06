<?php
// connexion.php
require_once 'config.php';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Gestion des erreurs
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Désactive les préparations émulées
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      // Format de récupération
    ];

    $pdo = new PDO($dsn, $User, $password, $options);
} catch (PDOException $e) {
    // NE PAS AFFICHER $e->getMessage() EN PRODUCTION
    error_log("Échec de la connexion : " . $e->getMessage());
    exit('Un problème est survenu avec la base de données');
}
?>
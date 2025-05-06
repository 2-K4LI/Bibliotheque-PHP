<?php
require_once 'includes/connexion.php';

try {
    $stmt = $pdo->query("SELECT * FROM livres ORDER BY titre");
    $livres = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Erreur de lecture : " . $e->getMessage());
    exit("Erreur lors du chargement des livres");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des livres</title>
</head>
<body>
    <h1>Catalogue de la bibliothèque</h1>
    <table border="1">
        <tr>
            <th>ISBN</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année</th>
            <th>Genre</th>
            <th>Action</th>
        </tr>
        <?php foreach ($livres as $livre): ?>
        <tr>
            <td><?= htmlspecialchars($livre['isbn']) ?></td>
            <td><?= htmlspecialchars($livre['titre']) ?></td>
            <td><?= htmlspecialchars($livre['auteur']) ?></td>
            <td><?= htmlspecialchars($livre['annee_publication']) ?></td>
            <td><?= htmlspecialchars($livre['genre']) ?></td>
            <td>
                <a href="supprimer-livre.php?isbn=<?= $livre['isbn'] ?>" 
                   onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="ajouter-livre.php">Ajouter un livre</a>
</body>
</html>

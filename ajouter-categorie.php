<?php
require_once 'includes/connexion.php';

$message = null;
$message_suppression = null;

// Ajout de catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_categorie = trim($_POST['nom_categorie']);
    if (!empty($nom_categorie)) {
        try {
            $pdo->prepare("INSERT INTO categories (categorie) VALUES (?)")->execute([$nom_categorie]);
            $succes = "Catégorie ajoutée !";
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'ajout.";
            error_log("Erreur ajout catégorie: " . $e->getMessage());
        }
    } else {
        $erreur = "Le nom est requis.";
    }
}

// Suppression de catégorie
if (isset($_GET['supprimer_categorie'])) {
    $id_a_supprimer = trim($_GET['supprimer_categorie']);
    if (is_numeric($id_a_supprimer) && $id_a_supprimer > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
            $stmt->execute([$id_a_supprimer]);
            if ($stmt->rowCount() > 0) {
                $message_suppression = "<p style='color:green'>Catégorie supprimée !</p>";
            } else {
                $message_suppression = "<p style='color:red'>Catégorie non trouvée.</p>";
            }
        } catch (PDOException $e) {
            $message_suppression = "<p style='color:red'>Erreur lors de la suppression.</p>";
            error_log("Erreur suppression catégorie: " . $e->getMessage());
        }
    } else {
        $message_suppression = "<p style='color:red'>ID de catégorie invalide.</p>";
    }
}

// Récupération des catégories
try {
    $stmt_categories = $pdo->query("SELECT * FROM categories");
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erreur_liste = "Erreur lors de la récupération des catégories.";
    error_log("Erreur récupération catégories: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une catégorie</title>
</head>
<body>
    <h1>Management catégorie</h1>

    <?php
    if (isset($erreur)) echo "<p style='color:red'>$erreur</p>";
    if (isset($succes)) echo "<p style='color:green'>$succes</p>";
    ?>

    <form method="POST">
        Nom de la catégorie: <input type="text" name="nom_categorie" required><br><br>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Liste des catégories</h2>
    <?php if (isset($erreur_liste)) echo "<p style='color:red'>$erreur_liste</p>"; ?>
    <?php if (isset($message_suppression)) echo $message_suppression; ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $categorie): ?>
                    <tr>
                        <td><?= htmlspecialchars($categorie['id']) ?></td>
                        <td><?= htmlspecialchars($categorie['categorie']) ?></td>
                        <td>
                            <a href="?supprimer_categorie=<?= $categorie['id'] ?>"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">Aucune catégorie enregistrée.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="index.php">Retour</a></p>
</body>
</html>
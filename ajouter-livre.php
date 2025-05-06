<?php
require_once 'includes/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des données
    $isbn = trim($_POST['isbn']);
    $titre = trim($_POST['titre']);
    $auteur = trim($_POST['auteur']);
    $annee = trim($_POST['annee']);
    $genre = trim($_POST['genre']);

    // Validation
    if (empty($isbn) || strlen($isbn) !== 13 || !is_numeric($isbn)) {
        $erreur = "ISBN invalide (13 chiffres requis)";
    } else {
        try {
            $sql = "INSERT INTO livres (isbn, titre, auteur, annee_publication, genre)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$isbn, $titre, $auteur, $annee, $genre]);
            $succes = "Livre ajouté avec succès !";
        } catch (PDOException $e) {
            error_log("Erreur d'insertion : " . $e->getMessage());
            $erreur = "Erreur lors de l'ajout du livre";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un livre</title>
</head>
<body>
    <h1>Nouveau livre</h1>
    <?php
    if (isset($erreur)) echo "<p style='color:red'>$erreur</p>";
    if (isset($succes)) echo "<p style='color:green'>$succes</p>"; 
    ?>

    <form method="POST">
        ISBN: <input type="text" name="isbn" required maxlength="13"><br>
        Titre: <input type="text" name="titre" required><br>
        Auteur: <input type="text" name="auteur" required><br>
        Année: <input type="number" name="annee" min="1900" max="<?= date('Y') ?>"><br>
        Genre:
        <select name="genre">
            <option value="Roman">Roman</option>
            <option value="Science-Fiction">Science-Fiction</option>
            <option value="Histoire">Histoire</option>
        </select><br><br>
        <button type="submit">Ajouter</button>
    </form>

    <a href="liste-livres.php">Voir la liste</a>
</body>
</html>
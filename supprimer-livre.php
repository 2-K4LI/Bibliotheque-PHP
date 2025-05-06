<?php
require_once 'includes/connexion.php';

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];

    try {
        $stmt = $pdo->prepare("DELETE FROM livres WHERE isbn = ?");
        $stmt->execute([$isbn]);

        if ($stmt->rowCount() > 0) {
            header('Location: liste-livres.php?success=1');
        } else {
            header('Location: liste-livres.php?error=notfound');
        }
        exit;
    } catch (PDOException $e) {
        error_log("Erreur de suppression : " . $e->getMessage());
        header('Location: liste-livres.php?error=dberror');
        exit;
    }
} else {
    header('Location: liste-livres.php');
    exit;
}
?>
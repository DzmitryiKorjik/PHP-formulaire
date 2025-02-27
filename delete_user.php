<?php 
require_once 'config.php';

session_start(); // Commençons la séance

$id = $_POST['id'] ?? null;

if (!$id || !is_numeric($id)) {
    $_SESSION['message'] = "Erreur : ID invalide !";
    header("Location: main.php");
    exit();
}

$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE id = ?");
$checkStmt->execute([$id]);
$userExists = $checkStmt->fetchColumn();

if ($userExists == 0) {
    $_SESSION['message'] = "Erreur : Aucun utilisateur avec cet ID !";
    header("Location: main.php");
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $_SESSION['message'] = "Utilisateur supprimé avec succès";
} catch(PDOException $e) {
    $_SESSION['message'] = "Erreur de suppression : " . $e->getMessage();
}

header("Location: main.php");
exit();
?>

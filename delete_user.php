<?php 
    require_once 'config.php';
    
    $id = $_POST['id'] ?? null;

    if (!$id || !is_numeric($id)) {
        echo "Erreur : ID invalide !";
        echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
        exit();
    }

    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE id = ?");
    $checkStmt->execute([$id]);
    $userExists = $checkStmt->fetchColumn();

    if ($userExists == 0) {
        echo "Erreur : Aucun utilisateur avec cet ID !";
        echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
        exit();
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        echo "Utilisateur supprimé avec succès";
    } catch(PDOException $e) {
        echo "Erreur de suppression : ". $e->getMessage();
    }

    echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
?>
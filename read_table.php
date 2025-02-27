<?php 
    require_once 'config.php';

    // Read
    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();

        // Récupérer les résultats
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
    } catch(PDOException $e) {
        echo "Erreur de lecture : " . $e->getMessage();
    }
?>
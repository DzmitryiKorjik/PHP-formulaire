<?php 
    require_once 'config.php';

    try {
        $pdo = Database::connect();
        echo "Connexion réussie !";
    } catch (Exception $e) {
        echo $e->getMessage();
    }

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
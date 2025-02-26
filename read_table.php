<?php 
    require_once 'config.php';

    // Read
    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();

        // Récupérer les résultats
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resultats);
        // foreach ($resultats as $row) {
        //     // Traiter chaque ligne de résultat
        // }
    } catch(PDOException $e) {
        echo "Erreur de lecture : " . $e->getMessage();
    }
?>
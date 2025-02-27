<?php
    require_once 'config.php';

    $nom = $_POST['last_name'] ?? null;
    $prenom = $_POST['first_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashage du mot de passe avec password_hash()
    $role = $_POST['user_role'] ?? null;

    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($role)) {
        echo "Erreur : Tous les champs sont obligatoires !";
        echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
        exit();
    }

    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
    $checkStmt->execute([$email]);
    if ($checkStmt->fetchColumn() > 0) {
        echo "Erreur : Cet email est déjà utilisé !";
        echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
        exit();
    }
    
    // Create

    try {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (last_name, first_name, email, password, user_role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $password, $role]);
        echo "Utilisateur ajouté avec succès.";
    } catch(PDOException $e) {
        echo "Erreur d'insertion : " . $e->getMessage();
    }

    echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
?>


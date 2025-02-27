<?php
require_once 'config.php';

try {
    $pdo = Database::connect();
    echo "Connexion réussie !";
} catch (Exception $e) {
    echo $e->getMessage();
}

// Vérifier si la requête est un POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Erreur : Requête invalide !";
    echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
    exit();
}

try {
    $nom = $_POST['last_name'] ?? null;
    $prenom = $_POST['first_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null; 
    $role = $_POST['user_role'] ?? null;

    // Validation email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Erreur : Adresse email invalide!");
    }

    // Validation nom et prénom
    $nom = trim($_POST['last_name'] ?? '');
    $prenom = trim($_POST['first_name'] ?? '');

    if (!preg_match('/^[a-zA-ZÀ-ÿ\s-]+$/u', $nom) || !preg_match('/^[a-zA-ZÀ-ÿ\s-]+$/u', $prenom)) {
        throw new Exception("Erreur : Le nom et le prénom ne doivent contenir que des lettres, des espaces ou des tirets !");
    }

    // Vérifier si tous les champs sont remplis
    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($role)) {
        throw new Exception("Erreur : Tous les champs sont obligatoires !");
    }

    // Hachage de mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si le même email existe déjà
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
    $checkStmt->execute([$email]);
    if ($checkStmt->fetchColumn() > 0) {
        throw new Exception("Erreur : Cet email est déjà utilisé !");
    }

    // Insérer un nouvel utilisateur
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (last_name, first_name, email, password, user_role) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $hashedPassword, $role]);

    echo "Utilisateur ajouté avec succès.";
} catch (Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo "Erreur d'insertion : " . $e->getMessage();
}

// Terminer le travail avec la base de données
$pdo = null;

echo '<br><a href="main.php"><button>Retour à l\'accueil</button></a>';
?>

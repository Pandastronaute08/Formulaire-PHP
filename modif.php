<?php
include('includes/db.php');
$conn = connect();

if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer et sécuriser l'ID de l'utilisateur à modifier
    $id = htmlspecialchars($_GET['id']);

    // Vérifier si l'utilisateur existe dans la base de données
    $stmt = $conn->prepare("SELECT * FROM login WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user) {
        // Rediriger vers une page d'erreur si l'utilisateur n'existe pas
        echo "<p>L'utilisateur n'existe pas</p>";
        exit();
    }
} else {
    // Rediriger vers une page d'erreur si l'ID n'est pas spécifié
    echo "<p>Aucun ID renseigné</p>";
    exit();
}

// Vérifier si des données ont été soumises via le formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Préparer la requête de mise à jour
    $sql = "UPDATE login SET login = :login, password = :password WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id', $id);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Rediriger vers la page de liste des utilisateurs après la mise à jour
        header("Location: welcome.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="container">
        <h2>Modifier un utilisateur</h2>
        <form action="" method="POST">
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" value="<?php echo $user['login']; ?>" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Modifier">
        </form>
        <a href="welcome.php">Retour à la liste des utilisateurs</a>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter un utilisateur</h2>
        <?php
        // Vérifier si le message de succès existe dans la session
        session_start();
        if (isset($_SESSION['success_message'])) {
            // Afficher le message de succès
            echo "<p>{$_SESSION['success_message']}</p>";

            // Supprimer le message de succès de la session
            unset($_SESSION['success_message']);
        }
        ?>
        <form action="add_process.php" method="POST">
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Ajouter">
        </form>
        <a href="welcome.php">Retour à la liste des utilisateurs</a>
    </div>
</body>
</html>
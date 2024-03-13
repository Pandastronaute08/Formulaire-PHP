<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="container">
        <h2>Delete User</h2>
        <?php
        // Vérifier si l'ID de l'utilisateur à supprimer est défini dans l'URL
        if(!empty($_GET['id']) && is_numeric($_GET['id'])) {

            // Inclure le fichier de connexion à la base de données
            include ('includes/db.php');
            $conn = connect();

            // Récupérer et sécuriser l'ID de l'utilisateur à supprimer
            $id = ($_GET['id']);

            // Dump de l'ID pour le débogage
            var_dump($id);

            // Préparer la requête de suppression
            $sql = "DELETE FROM `login` WHERE id = ?";

            // Dump de la requête SQL pour le débogage
            var_dump($sql);

            // Préparer et exécuter la requête de suppression
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($id));

            // Dump du résultat de l'exécution pour le débogage
            var_dump($stmt);

            // Vérifier si la suppression a réussi
            if ($stmt) {
                echo "<p>L'utilisateur a été supprimé avec succès.</p>";
            } else {
                echo "<p>Erreur lors de la suppression de l'utilisateur.</p>";
            }
        } else {
            echo "<p>ID de l'utilisateur à supprimer non spécifié.</p>";
        }
        ?>
        <a href="welcome.php">Retour à la liste des utilisateurs</a>
    </div>
</body>
</html>
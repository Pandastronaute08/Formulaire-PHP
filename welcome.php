<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="assets/styles.css">

    <!-- Ajout de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="container">
    <h1>Bienvenue !</h1>
    <p>Vous êtes bien connecté.</p>
</div>
<div class="logout">
    <a href="logout.php">Déconnexion</a>
</div>

<?php
include ('includes/db.php');
$conn = connect();

$req1= "SELECT id, login FROM login";
$stmt1 = $conn->prepare($req1);
$stmt1->execute();
$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Affichage des résultats -->
<div class="container">
    <h2>Liste des utilisateurs</h2>
    <table>
        <thead>
            <tr>
                <th>Login</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result1 as $row): ?>
                <tr>
                    <td><?php echo $row['login']; ?></td>
                    <td>
                    <a href="modif.php?id=<?php echo $row['id']; ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                        <!-- Ajout de l'icône de suppression -->
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="container">
    <h2>Ajouter un utilisateur</h2>
    <a href="add.php">
        <i class="fas fa-user-plus"></i> Ajouter un utilisateur
    </a>
</div>

</body>
</html>
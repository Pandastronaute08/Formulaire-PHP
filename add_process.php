<?php
// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de connexion à la base de données
    include('includes/db.php');
    $conn = connect();

    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Préparer la requête d'insertion
    $sql = "INSERT INTO login (login, password) VALUES (:login, :password)";
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Stocker le message de succès dans la session
        session_start();
        $_SESSION['success_message'] = "Utilisateur ajouté avec succès.";

        // Rediriger vers la page d'ajout
        header("Location: add.php");
        exit();
    } else {
        // Afficher un message d'erreur en cas d'échec de l'insertion
        echo "Erreur lors de l'ajout de l'utilisateur.";
    }
}
?>
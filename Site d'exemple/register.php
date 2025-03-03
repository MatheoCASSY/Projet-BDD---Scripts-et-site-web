<?php
$pdo = new PDO("mysql:host=localhost;dbname=airbnb", "root", "");

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user) {
        $errorMessage = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $errorMessage = "Les mots de passe ne correspondent pas.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, phone_number, description, profile_image_id, owned_rooms_count, property_count) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['name'],
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_DEFAULT),
                $_POST['phone_number'],
                $_POST['description'],
                1,
                0, 
                0 
            ]);
            $successMessage = "Compte créé avec succès! <a href='home.php'>Retour à la page d'accueil</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte - Airbnb</title>
    <link rel="stylesheet" href="styleregisterlogin.css">
</head>
<body>
    <div class="container">

    <button onclick="window.location.href='home.php';">Retour à l'accueil</button>

        <h1>Créer un compte</h1>

        <?php if ($successMessage): ?>
            <div class="success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form method="POST" action="signup.php">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" placeholder="Votre nom" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Votre email" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>

            <label for="confirm_password">Confirmer le mot de passe</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer votre mot de passe" required>

            <label for="phone_number">Numéro de téléphone</label>
            <input type="text" name="phone_number" id="phone_number" placeholder="Numéro de téléphone" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Une brève description de vous" required></textarea>

            <button type="submit">S'inscrire</button>
        </form>

        <p>Déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
    </div>
</body>
</html>

<?php
$pdo = new PDO("mysql:host=localhost;dbname=airbnb", "root", "");

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['user_name'] = $user['name']; 
        header("Location: home.php"); 
        exit();
    } else {
        $errorMessage = "Identifiants incorrects. Veuillez vérifier votre email et mot de passe.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Airbnb</title>
    <link rel="stylesheet" href="styleregisterlogin.css">
</head>
<body>
    <div class="container">
    <button onclick="window.location.href='home.php';">Retour à l'accueil</button>

        <h1>Se connecter</h1>

        <?php if ($errorMessage): ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Votre email" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>

            <button type="submit">Se connecter</button>
        </form>

        <p>Pas encore de compte ? <a href="register.php">Créez-en un ici</a></p>
    </div>
</body>
</html>

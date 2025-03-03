<?php
$pdo = new PDO("mysql:host=localhost;dbname=airbnb", "root", "");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT)]);
    echo "Compte créé avec succès! <a href='home.php'>Retour</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Créer un compte</h1>
    <form method='POST'>
        <input type='text' name='name' placeholder='Nom' required>
        <input type='email' name='email' placeholder='Email' required>
        <input type='password' name='password' placeholder='Mot de passe' required>
        <button type='submit'>S'inscrire</button>
    </form>
</div>
</body>
</html>
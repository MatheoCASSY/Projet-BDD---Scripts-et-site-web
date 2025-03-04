<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=airbnb;charset=utf8", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->query("SELECT home_type, summary, price FROM rooms");

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Airbnb</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="header">
    <div class="navbar">
        <a href="index.php" class="logo">
            <img src="airbnb_logo.png" alt="Airbnb Logo"> 
        </a>
        <nav class="nav-links">
            <a href="register.php">Créer un compte</a>
            <a href="login.php">Se connecter</a>
            <a href="addroom.php" class="add-room-btn">Ajouter mon logement</a>
        </nav>
    </div>
</header>

<section class="hero">
    <h1>Bienvenue sur Airbnb</h1>
    <p>Trouvez des logements uniques partout dans le monde.</p>
    <a href="explorer.php" class="cta-btn">Explorer les logements</a>
</section>

<section class="rooms">
    <h2>Nos logements</h2>
    <div class="room-list">
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="room-item">
                <div class="room-details">
                    <h3><?= htmlspecialchars($row['home_type'] ?? 'Type inconnu') ?></h3>
                    <p><?= htmlspecialchars($row['summary'] ?? 'Pas de description disponible') ?></p>
                    <span class="price"><?= htmlspecialchars($row['price'] ?? 'Prix inconnu') ?>€ / nuit</span>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<footer class="footer">
    <p>© 2025 Airbnb Clone. Tous droits réservés.</p>
</footer>

</body>
</html>

<?php
$pdo = new PDO("mysql:host=localhost;dbname=airbnb", "root", "");
$stmt = $pdo->query("SELECT * FROM rooms");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Liste des logements</h1>
    <ul>
        <?php while ($row = $stmt->fetch()) { ?>
            <li><?= htmlspecialchars($row['name']) ?> - <?= htmlspecialchars($row['price']) ?>€/nuit</li>
        <?php } ?>
    </ul>
    <a href='addroom.php'>Ajouter un logement</a> | <a href='register.php'>Créer un compte</a>
</div>
</body>
</html>


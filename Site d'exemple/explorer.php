<?php
$pdo = new PDO("mysql:host=localhost;dbname=airbnb", "root", "");

$query = "SELECT * FROM rooms"; 
$stmt = $pdo->query($query);
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorer les Logements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
        }

        .rooms-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .room {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .room-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .room h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #333;
        }

        .room p {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
        }

        .room-details-link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .room-details-link:hover {
            background-color: #0056b3;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #a94442;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #a94442;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Explorer les Logements</h1>

    <div class="rooms-list">
        <?php foreach ($rooms as $room): ?>
            <div class="room">
                <h2><?php echo htmlspecialchars($room['home_type']) . ' - ' . htmlspecialchars($room['room_type']); ?></h2>
                <p><strong>Adresse:</strong> <?php echo htmlspecialchars($room['address']); ?></p>
                <p><strong>Ville:</strong> <?php echo htmlspecialchars($room['city']); ?></p>
                <p><strong>Prix par nuit:</strong> <?php echo htmlspecialchars($room['price']); ?> €</p>
                <p><strong>Capacité:</strong> <?php echo htmlspecialchars($room['total_occupancy']); ?> personnes</p>
                <a href="details.php?id=<?php echo $room['id']; ?>" class="room-details-link">Voir les détails</a>
            </div>
        <?php endforeach; ?>
    </div>

    <button onclick="window.location.href='home.php';">Retour à l'accueil</button>
</div>

</body>
</html>

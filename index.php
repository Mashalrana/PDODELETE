

<?php
// Databasegegevens
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Maak een verbinding met de database
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $conn = new PDO($dsn, $user, $pass, $options);
    echo "DB connection successful" . "<br \n)";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
// Haal alle gegevens op uit de tabel 'producten' in een mooie volgorde
$stmt = $conn->prepare("SELECT * FROM producten ORDER BY product_naam");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Producten</title>
</head>
<body>
    <h1>Producten</h1>
    <ul>
        
    
    <?php foreach ($products as $product) { ?>
            <li><?php echo $product['product_naam']; ?></li>
        <?php } ?>
    </ul>
    <a href="delete.php?product_code=9">Verwijder product 9</a>
</body>
</html>

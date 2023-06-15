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
// Zorg ervoor dat PDO uitzonderingen gooit bij fouten
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Haal de product_code op uit de queryparameters
$productCode = $_GET['product_code'];

// Verwijder het product met de opgegeven product_code
$stmt = $conn->prepare("DELETE FROM producten WHERE producten_code = :producten_code");
$stmt->bindParam(':producten_code', $productCode);
$stmt->execute();

echo "Product met product_code $productCode is verwijderd.";
?>

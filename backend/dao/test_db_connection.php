<?php
$host = 'localhost';
$port = 3307;
$dbname = 'eventdb';
$username = 'root';
$password = ''; 

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Uspješna konekcija sa bazom!";
} catch (PDOException $e) {
    echo "❌ Konekcija neuspješna: " . $e->getMessage();
}
?>

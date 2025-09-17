<?php
$host = "localhost"; // Changed from dbucmpbi1nxmwx
$username = "uzrprp3rmtdfr";
$password = "#[qI(M3@k1bz";
$database = "dbucmpbi1nxmwx";
 
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

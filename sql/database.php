<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beveleging_app";

// Maak verbinding
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
echo "Verbinding succesvol";
?>
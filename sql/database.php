<?php
$servername = "localhost";
$username = "root";
$password = "Welkom01";
$dbname = "LMS_Veiligheid";

// Maak verbinding
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
echo "Verbinding succesvol";
?>
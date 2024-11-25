<?php
$servername = "localhost";
$username = "root";
$password = ""; // $password = "Welkom01"; Ik heb geen password voor mijn root, dus moet dit leeg zijn als ik hem will zien. -Tim
$dbname = "LMS_Veiligheid";

// Maak verbinding
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
echo "Verbinding succesvol";
?>
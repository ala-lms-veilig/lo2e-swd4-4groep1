<?php
require_once "./sql/database.php";

// Maak een nieuwe databaseverbinding
$database = new Database();
$conn = $database->conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $e_mail = $_POST['e_mail'];
    $voor_naam = $_POST['voor_naam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achter_naam = $_POST['achter_naam'];
    $foto = $_POST['foto'];
    $wachtwoord = $_POST['wachtwoord'];
    $telefoon_nummer = $_POST['telefoon_nummer'];
    $rol_id = $_POST['rol_id'];

    $stmt = $conn->prepare('UPDATE gebruikers SET e_mail = ?, voor_naam = ?, tussenvoegsel = ?, achter_naam = ?, foto = ?, wachtwoord = ?, telefoon_nummer = ?, rol_id = ? WHERE user_id = ?');
    $stmt->bind_param('ssssssssi', $e_mail, $voor_naam, $tussenvoegsel, $achter_naam, $foto, $wachtwoord, $telefoon_nummer, $rol_id, $user_id);

    if ($stmt->execute()) {
        echo "Gebruiker succesvol bijgewerkt.";
    } else {
        echo "Fout bij het bijwerken van de gebruiker: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: user_admin_template.php");
exit();

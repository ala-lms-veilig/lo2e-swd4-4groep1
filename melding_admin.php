<?php   

if (session_status() == PHP_SESSION_NONE) {
    session_start();
};





    require_once './sql/database.php';
    
    // Create database instance and get connection
    $database = new Database();
    $conn = $database->conn;
    
    // Rest of your code remains the same
    try {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            throw new Exception("Je moet ingelogd zijn om deze pagina te bekijken.");
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: inlog.php");
        exit;
    }
  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meldingen admin</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php require_once 'includes/header.php';?>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Melding nummer</th>
                    <th>Melder</th>
                    <th>Melding onderwerp</th>
                    <th>Melding info</th>
                    <th>Datum van melding</th>
                    <th>Afgehandeld</th>
                    <th>Gebruikers mail</th>
                </tr>
            </thead>
            <?php
// Update your SQL query
$sql = "SELECT * FROM incident";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['melder']) . "</td>";
        echo "<td>" . htmlspecialchars($row['onderwerp']) . "</td>";
        echo "<td>" . htmlspecialchars($row['info']) . "</td>";
        echo "<td>" . htmlspecialchars($row['datum']) . "</td>";
        echo "<td>" . htmlspecialchars($row['afgehandeld']) . "</td>";
        echo "<td>" . htmlspecialchars($row['gebruiker_email']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Geen incidenten gevonden</td></tr>";
}
?>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>
</html>
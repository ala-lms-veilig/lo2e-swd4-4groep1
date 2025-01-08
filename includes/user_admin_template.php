<?php
require_once "./sql/database.php";

// Maak een nieuwe databaseverbinding
$database = new Database();
$conn = $database->conn;

// Haal alle gebruikers op uit de database
$stmt = $conn->prepare('SELECT user_id, e_mail, voor_naam, tussenvoegsel, achter_naam, foto, wachtwoord, telefoon_nummer, rol_id FROM gebruikers');
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gebruikersbeheer</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
    <h1>Gebruikersbeheer</h1>
    <table border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <th>E-mail</th>
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Foto</th>
                <th>Wachtwoord</th>
                <th>Telefoonnummer</th>
                <th>Rol ID</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['e_mail']; ?></td>
                <td><?php echo $row['voor_naam']; ?></td>
                <td><?php echo $row['tussenvoegsel']; ?></td>
                <td><?php echo $row['achter_naam']; ?></td>
                <td><img src="path/to/images/<?php echo $row['foto']; ?>" alt="Foto" width="50"></td>
                <td><?php echo $row['wachtwoord']; ?></td>
                <td><?php echo $row['telefoon_nummer']; ?></td>
                <td><?php echo $row['rol_id']; ?></td>
                <td>
                    <a href="edit_user.php?user_id=<?php echo $row['user_id']; ?>">Bewerken</a>
                    <a href="delete_user.php?user_id=<?php echo $row['user_id']; ?>" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Verwijderen</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="add_user.php">Nieuwe gebruiker toevoegen</a>
</body>
</html>

<?php

?>
<?php
require_once "./sql/database.php";

// Maak een nieuwe databaseverbinding
$database = new Database();
$conn = $database->conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
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
    } elseif (isset($_POST['delete'])) {
        $user_id = $_POST['user_id'];

        $stmt = $conn->prepare('DELETE FROM gebruikers WHERE user_id = ?');
        $stmt->bind_param('i', $user_id);

        if ($stmt->execute()) {
            echo "Gebruiker succesvol verwijderd.";
        } else {
            echo "Fout bij het verwijderen van de gebruiker: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['add'])) {
        $e_mail = $_POST['e_mail'];
        $voor_naam = $_POST['voor_naam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achter_naam = $_POST['achter_naam'];
        $foto = $_POST['foto'];
        $wachtwoord = $_POST['wachtwoord'];
        $telefoon_nummer = $_POST['telefoon_nummer'];
        $rol_id = $_POST['rol_id'];

        $stmt = $conn->prepare('INSERT INTO gebruikers (e_mail, voor_naam, tussenvoegsel, achter_naam, foto, wachtwoord, telefoon_nummer, rol_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssssss', $e_mail, $voor_naam, $tussenvoegsel, $achter_naam, $foto, $wachtwoord, $telefoon_nummer, $rol_id);

        if ($stmt->execute()) {
            echo "Gebruiker succesvol toegevoegd.";
        } else {
            echo "Fout bij het toevoegen van de gebruiker: " . $stmt->error;
        }

        $stmt->close();
    }
}

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
                <form method="post">
                    <td><?php echo $row['user_id']; ?></td>
                    <td><input type="email" name="e_mail" value="<?php echo $row['e_mail']; ?>"></td>
                    <td><input type="text" name="voor_naam" value="<?php echo $row['voor_naam']; ?>"></td>
                    <td><input type="text" name="tussenvoegsel" value="<?php echo $row['tussenvoegsel']; ?>"></td>
                    <td><input type="text" name="achter_naam" value="<?php echo $row['achter_naam']; ?>"></td>
                    <td><input type="text" name="foto" value="<?php echo $row['foto']; ?>"></td>
                    <td><input type="password" name="wachtwoord" value="<?php echo $row['wachtwoord']; ?>"></td>
                    <td><input type="text" name="telefoon_nummer" value="<?php echo $row['telefoon_nummer']; ?>"></td>
                    <td><input type="number" name="rol_id" value="<?php echo $row['rol_id']; ?>"></td>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <button type="submit" name="update">Update</button>
                        <button type="submit" name="delete">Verwijderen</button>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <h2>Nieuwe gebruiker toevoegen</h2>
    <form method="post">
        <label for="e_mail">E-mail:</label>
        <input type="email" name="e_mail" required>
        <label for="voor_naam">Voornaam:</label>
        <input type="text" name="voor_naam" required>
        <label for="tussenvoegsel">Tussenvoegsel:</label>
        <input type="text" name="tussenvoegsel">
        <label for="achter_naam">Achternaam:</label>
        <input type="text" name="achter_naam" required>
        <label for="foto">Foto:</label>
        <input type="text" name="foto">
        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" name="wachtwoord" required>
        <label for="telefoon_nummer">Telefoonnummer:</label>
        <input type="text" name="telefoon_nummer">
        <label for="rol_id">Rol ID:</label>
        <input type="number" name="rol_id" required>
        <button type="submit" name="add">Toevoegen</button>
    </form>
</body>
</html>

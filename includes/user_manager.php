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

        $stmt = $conn->prepare('UPDATE gebruikers SET e_mail = ?, voor_naam = ?, tussenvoegsel = ?, achter_naam = ?, foto = ?, wachtwoord = ?, telefoon_nummer = ?, rol_id = ? WHERE user_id = ? AND rol_id = 0');
        $stmt->bind_param('ssssssssi', $e_mail, $voor_naam, $tussenvoegsel, $achter_naam, $foto, $wachtwoord, $telefoon_nummer, $rol_id, $user_id);

        if ($stmt->execute()) {
            echo "Gebruiker succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van de gebruiker: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $user_id = $_POST['user_id'];

        $stmt = $conn->prepare('DELETE FROM gebruikers WHERE user_id = ? AND rol_id = 0');
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

        $stmt = $conn->prepare('INSERT INTO gebruikers (e_mail, voor_naam, tussenvoegsel, achter_naam, foto, wachtwoord, telefoon_nummer, rol_id) VALUES (?, ?, ?, ?, ?, ?, ?, 0)');
        $stmt->bind_param('sssssss', $e_mail, $voor_naam, $tussenvoegsel, $achter_naam, $foto, $wachtwoord, $telefoon_nummer);

        if ($stmt->execute()) {
            echo "Gebruiker succesvol toegevoegd.";
        } else {
            echo "Fout bij het toevoegen van de gebruiker: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Haal alle gebruikers op met rol_id 0 uit de database
$stmt = $conn->prepare('SELECT user_id, e_mail, voor_naam, tussenvoegsel, achter_naam, foto, wachtwoord, telefoon_nummer, rol_id FROM gebruikers WHERE rol_id = 0');
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gebruikersbeheer</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <h1 class="admin-title">Gebruikersbeheer</h1>
    <table class="admin-table">
        <thead>
            <tr class="table-header">
                <th class="table-cell">User ID</th>
                <th class="table-cell">E-mail</th>
                <th class="table-cell">Voornaam</th>
                <th class="table-cell">Tussenvoegsel</th>
                <th class="table-cell">Achternaam</th>
                <th class="table-cell">Foto</th>
                <th class="table-cell">Wachtwoord</th>
                <th class="table-cell">Telefoonnummer</th>
                <th class="table-cell">Rol ID</th>
                <th class="table-cell">Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr class="table-row">
                <form method="post">
                    <td class="table-cell"><?php echo $row['user_id']; ?></td>
                    <td class="table-cell"><input type="email" name="e_mail" value="<?php echo $row['e_mail']; ?>"></td>
                    <td class="table-cell"><input type="text" name="voor_naam" value="<?php echo $row['voor_naam']; ?>"></td>
                    <td class="table-cell"><input type="text" name="tussenvoegsel" value="<?php echo $row['tussenvoegsel']; ?>"></td>
                    <td class="table-cell"><input type="text" name="achter_naam" value="<?php echo $row['achter_naam']; ?>"></td>
                    <td class="table-cell"><input type="text" name="foto" value="<?php echo $row['foto']; ?>"></td>
                    <td class="table-cell"><input type="password" name="wachtwoord" value="<?php echo $row['wachtwoord']; ?>"></td>
                    <td class="table-cell"><input type="text" name="telefoon_nummer" value="<?php echo $row['telefoon_nummer']; ?>"></td>
                    <td class="table-cell"><input type="number" name="rol_id" value="<?php echo $row['rol_id']; ?>"></td>
                    <td class="table-cell">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <button type="submit" name="update" class="btn btn-update">Update</button>
                        <button type="submit" name="delete" class="btn btn-delete">Verwijderen</button>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <h2 class="admin-subtitle">Nieuwe gebruiker toevoegen</h2>
    <form method="post" class="admin-form">
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
        <button type="submit" name="add" class="btn btn-add">Toevoegen</button>
    </form>
</body>
</html>
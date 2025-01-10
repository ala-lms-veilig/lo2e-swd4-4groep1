<?php
require_once "./sql/database.php";

// Maak een nieuwe databaseverbinding
$database = new Database();
$conn = $database->conn;

$message = "";

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
            $message = "Gebruiker succesvol bijgewerkt.";
        } else {
            $message = "Fout bij het bijwerken van de gebruiker: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $user_id = $_POST['user_id'];

        $stmt = $conn->prepare('DELETE FROM gebruikers WHERE user_id = ?');
        $stmt->bind_param('i', $user_id);

        if ($stmt->execute()) {
            $message = "Gebruiker succesvol verwijderd.";
        } else {
            $message = "Fout bij het verwijderen van de gebruiker: " . $stmt->error;
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
            $message = "Gebruiker succesvol toegevoegd.";
        } else {
            $message = "Fout bij het toevoegen van de gebruiker: " . $stmt->error;
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

    <link rel="stylesheet" href="../styles/style.css">

</head>
<body class="admin-body" id="admin-body">
<?php if ($message): ?>
        <div class="popup active" id="popup">
            <p><?php echo $message; ?></p>
            <button class="close-btn" onclick="closePopup()">Close</button>
        </div>
    <?php endif; ?>

    <script>
        function closePopup() {
            document.getElementById('popup').classList.remove('active');
        }
    </script>
<h1 class="admin-title" id="admin-title">Gebruikersbeheer</h1>
    <table border="1" class="user-table" id="user-table">
        <thead>
            <tr>
                <th class="user-table-header" id="user-id-header">User ID</th>
                <th class="user-table-header" id="email-header">E-mail</th>
                <th class="user-table-header" id="voornaam-header">Voornaam</th>
                <th class="user-table-header" id="tussenvoegsel-header">Tussenvoegsel</th>
                <th class="user-table-header" id="achternaam-header">Achternaam</th>
                <th class="user-table-header" id="foto-header">Foto</th>
                <th class="user-table-header" id="wachtwoord-header">Wachtwoord</th>
                <th class="user-table-header" id="telefoonnummer-header">Telefoonnummer</th>
                <th class="user-table-header" id="rolid-header">Rol ID</th>
                <th class="user-table-header" id="acties-header">Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr class="user-table-row" id="user-row-<?php echo $row['user_id']; ?>">
                <form method="post" class="user-form" id="user-form-<?php echo $row['user_id']; ?>">
                    <td class="user-table-cell" id="user-id-<?php echo $row['user_id']; ?>"><?php echo $row['user_id']; ?></td>
                    <td class="user-table-cell" id="user-email-cell-<?php echo $row['user_id']; ?>"><input type="email" name="e_mail" value="<?php echo $row['e_mail']; ?>" class="user-input" id="user-email-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-voornaam-cell-<?php echo $row['user_id']; ?>"><input type="text" name="voor_naam" value="<?php echo $row['voor_naam']; ?>" class="user-input" id="user-voornaam-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-tussenvoegsel-cell-<?php echo $row['user_id']; ?>"><input type="text" name="tussenvoegsel" value="<?php echo $row['tussenvoegsel']; ?>" class="user-input" id="user-tussenvoegsel-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-achternaam-cell-<?php echo $row['user_id']; ?>"><input type="text" name="achter_naam" value="<?php echo $row['achter_naam']; ?>" class="user-input" id="user-achternaam-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-foto-cell-<?php echo $row['user_id']; ?>"><input type="text" name="foto" value="<?php echo $row['foto']; ?>" class="user-input" id="user-foto-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-wachtwoord-cell-<?php echo $row['user_id']; ?>"><input type="password" name="wachtwoord" value="<?php echo $row['wachtwoord']; ?>" class="user-input" id="user-wachtwoord-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-telefoonnummer-cell-<?php echo $row['user_id']; ?>"><input type="text" name="telefoon_nummer" value="<?php echo $row['telefoon_nummer']; ?>" class="user-input" id="user-telefoonnummer-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-rolid-cell-<?php echo $row['user_id']; ?>"><input type="number" name="rol_id" value="<?php echo $row['rol_id']; ?>" class="user-input" id="user-rolid-<?php echo $row['user_id']; ?>"></td>
                    <td class="user-table-cell" id="user-acties-cell-<?php echo $row['user_id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <button type="submit" name="update" class="user-button" id="update-button-<?php echo $row['user_id']; ?>">Update</button>
                        <button type="submit" name="delete" class="user-button1" id="delete-button-<?php echo $row['user_id']; ?>">Verwijderen</button>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <h2 class="add-user-title" id="add-user-title">Nieuwe gebruiker toevoegen</h2>
    <form method="post" class="add-user-form" id="add-user-form">
        <label for="e_mail" class="add-user-label" id="label-email">E-mail:</label>
        <input type="email" name="e_mail" required class="add-user-input" id="input-email">
        <label for="voor_naam" class="add-user-label" id="label-voornaam">Voornaam:</label>
        <input type="text" name="voor_naam" required class="add-user-input" id="input-voornaam">
        <label for="tussenvoegsel" class="add-user-label" id="label-tussenvoegsel">Tussenvoegsel:</label>
        <input type="text" name="tussenvoegsel" class="add-user-input" id="input-tussenvoegsel">
        <label for="achter_naam" class="add-user-label" id="label-achternaam">Achternaam:</label>
        <input type="text" name="achter_naam" required class="add-user-input" id="input-achternaam">
        <label for="foto" class="add-user-label" id="label-foto">Foto:</label>
        <input type="text" name="foto" class="add-user-input" id="input-foto">
        <label for="wachtwoord" class="add-user-label" id="label-wachtwoord">Wachtwoord:</label>
        <input type="password" name="wachtwoord" required class="add-user-input" id="input-wachtwoord">
        <label for="telefoon_nummer" class="add-user-label" id="label-telefoonnummer">Telefoonnummer:</label>
        <input type="text" name="telefoon_nummer" class="add-user-input" id="input-telefoonnummer">
        <label for="rol_id" class="add-user-label" id="label-rolid">Rol ID:</label>
        <input type="number" name="rol_id" required class="add-user-input" id="input-rolid">
        <button type="submit" name="add" class="add-user-button" id="add-button">Toevoegen</button>
    </form>
</body>
</html>

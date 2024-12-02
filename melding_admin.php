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
    <?php require_once 'includes/header.php';?><body>
    <main>
        <form method="post">
            <input type="email" name="gebruikers_email" placeholder="Melder email" required>
            <input type="text" name="melding_onderwerp" placeholder="Melding onderwerp" required>
            <input type="date" name="datum_van_melding" placeholder="Datum van melding" required>
            <input type="text" name="afgehandeld" placeholder="Afgehandeld" required>
            <input type="text" name="prioriteit" placeholder="Prioriteit" required>
            <input type="text" name="toren" placeholder="Toren" required>
            <input type="text" name="verdieping" placeholder="Verdieping" required>
            <input type="text" name="klas_ruimte" placeholder="Klas ruimte" required>
            <button type="submit" name="add_melding">Voeg melding toe</button>
        </form>

        <table id="admin-table">
            <thead class="table_header">
                <tr>
                    <th class="table_cell">Melding nummer</th>
                    <th class="table_cell">Melder email</th>
                    <th class="table_cell">Melding onderwerp</th>
                    <th class="table_cell">datum van melding</th>
                    <th class="table_cell">afgehandeld</th>
                    <th class="table_cell">prioriteit</th>
                    <th class="table_cell">toren</th>
                    <th class="table_cell">verdieping</th>
                    <th class="table_cell">klas ruimte</th>
                    <th class="table_cell">Acties</th>
                </tr>
            </thead>
            <?php
            // Update your SQL query
            $sql = "SELECT * FROM meldingen";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<tr class="table__row">';
                    echo '<td class="table__cell">' . htmlspecialchars($row['melding_nummer']) . '</td>';
                    echo '<td class="table__cell">'. htmlspecialchars($row['gebruikers_email']) . "</td>";
                    echo '<td class="table__cell">'. htmlspecialchars($row['melding_onderwerp']) . "</td>";
                    echo '<td class="table__cell">'. htmlspecialchars($row['datum_van_melding']) . "</td>";
                    echo '<td class="table__cell">'. htmlspecialchars($row['afgehandeld']) . "</td>";
                    echo '<td class="table__cell">'. htmlspecialchars($row['prioriteit']) . "</td>";
                    echo '<td class="table__cell">'. htmlspecialchars($row['toren']) . "</td>";
                    echo '<td class="table__cell">'. htmlspecialchars($row['verdieping']) . "</td>";
                    echo '<td class="table__cell">'. htmlspecialchars($row['klas_ruimte']) . "</td>";
                    echo '<td><form method="post"><button type="submit" name="delete_melding" value="' . htmlspecialchars($row['melding_nummer']) . '">Verwijder</button></form></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Geen incidenten gevonden</td></tr>";
            }
            ?>
        </table>
    </main>

    <?php
    if (isset($_POST['add_melding'])) {
        $melder_email = $_POST['gebruikers_email'];
        $melding_onderwerp = $_POST['melding_onderwerp'];
        $datum_van_melding = $_POST['datum_van_melding'];
        $afgehandeld = $_POST['afgehandeld'];
        $prioriteit = $_POST['prioriteit'];
        $toren = $_POST['toren'];
        $verdieping = $_POST['verdieping'];
        $klas_ruimte = $_POST['klas_ruimte'];

        $sql = "INSERT INTO meldingen (gebruikers_email, melding_onderwerp, datum_van_melding, afgehandeld, prioriteit, toren, verdieping, klas_ruimte) VALUES ('$melder_email', '$melding_onderwerp', '$datum_van_melding', '$afgehandeld', '$prioriteit', '$toren', '$verdieping', '$klas_ruimte')";
        if ($conn->query($sql) === TRUE) {
            echo "Nieuwe melding succesvol toegevoegd";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['delete_melding'])) {
        $melding_nummer = $_POST['delete_melding'];

        $sql = "DELETE FROM meldingen WHERE melding_nummer='$melding_nummer'";
        if ($conn->query($sql) === TRUE) {
            echo "Melding succesvol verwijderd";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html> 
<?php   




try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            throw new Exception("Je moet ingelogd zijn om deze pagina te bekijken.");
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: inlog.php");
        exit;
    }

require_once './sql/database.php';
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
            <tbody>
                <?php
                $sql = "SELECT * FROM meldingen";
                $result = $conn->query($sql);
                
                // while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['melder'] . "</td>";
                    echo "<td>" . $row['onderwerp'] . "</td>";
                    echo "<td>" . $row['info'] . "</td>";
                    echo "<td>" . $row['datum'] . "</td>";
                    echo "<td>" . $row['afgehandeld'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                // }
                ?>
            </tbody>
        </table>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>
</html>
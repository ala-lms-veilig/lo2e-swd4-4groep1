<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <link rel="stylesheet" href="styles/styling-v2.css">
    <link rel="stylesheet" href="styles/inlog.css">
    <!-- <script src="./scripts/inlogg.js"></script> -->
    <!-- ik heb de script laten staan omdat ik het nog moet laten zien aan docent  -->
</head>
<body>
    <?php
    require_once 'includes/header.php'; 

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'sql/database.php';
    $db = new Database();
    $conn = $db->conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Email = $_POST['email'];
        $wachtwoord = $_POST['password'];

        
        $stmt = $conn->prepare('SELECT voor_naam FROM gebruikers WHERE e_mail = ? AND Wachtwoord = ?');
        if ($stmt) {
            $stmt->bind_param('ss', $Email, $wachtwoord);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
               //  naam opslaan in session
                $_SESSION['voor_naam'] = $user['voor_naam'];
                $_SESSION['loggedin'] = true;
                echo "Login successful!";
                sleep(1);
                header("Location: index.php");
            } else {
                echo "Login failed. Invalid email or password.";
            }

            $stmt->close();
        } else {
            echo "Failed to prepare the SQL statement.";
        }

        $conn->close();
    }
    ?>
    
    <main id="inlog">
        <h2>Login</h2>
        <form id="loginForm" method="POST">
            <label id="bq" for="email">Username:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label id="bier" for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button class="button-login" type="submit">Login</button>
        </form>
        <div id="message"></div>
    </main>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
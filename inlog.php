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
    <?php   require_once 'includes/header.php'; 

session_start();
require_once 'sql/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    // Query to check the username and password
    $stmt = $conn->prepare('SELECT username, role FROM users WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Store username and role in session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
       
    } else {
     "failed ";
    }

    $stmt->close();
    $conn->close();
}
?>
    

    <main id="inlog">
        <h2>Login</h2>
        <form id="loginForm" method="POST">
            <label id="bq" for="username">Username:</label>
            <input type="text" id="username" name="username" required>
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


<?php 




?>




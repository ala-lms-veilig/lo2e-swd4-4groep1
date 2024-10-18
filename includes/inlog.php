<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="styles/inlopstyle.css">
    <script src="scripts/inglog.js"></script>
</head>
<body>
    
    <?php require 'includes/header.php'; ?>

   
    <main id="inlog">
        <form id="loginForm" method="post">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button id="subit" type="submit">Inloggen</button>
        </form>
        <div id="message"></div>
    </main>

    <?php require 'includes/footer.php'; ?>


</body>
</html>
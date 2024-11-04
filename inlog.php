<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="./styles/inlog.css">
    <script src="./scripts/inlogg.js"></script>
</head>
<body>
    <?php require_once 'includes/header.php'; ?>
    

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
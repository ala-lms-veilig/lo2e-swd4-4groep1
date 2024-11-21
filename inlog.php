<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./js/script.js" defer></script>
    <title>Account</title>

    <link rel="stylesheet" href="styles/styling-v2.css">
    <link rel="stylesheet" href="styles/inlog.css">
    <!-- <script src="./scripts/inlogg.js"></script> -->
    <!-- ik heb de script laten staan omdat ik het nog moet laten zien aan docent  -->
</head>

<body>

    <?php require_once 'includes/header.php'; ?>

    <main id="inlog">
        <h2>Login</h2>
        <form id="loginForm" method="POST" action="./includes/api.php?action=login">
            <label id="bq" for="email">Username:</label>
            <input value="manager@example.com" type="email" id="email" name="email" required>
            <br>
            <label id="bier" for="password">Password:</label>
            <input value="password123" type="password" id="password" name="password" required>
            <br>
            <button class="button-login" type="submit">Login</button>
        </form>
        <div id="message"></div>
    </main>

    <?php require_once 'includes/footer.php'; ?>

</body>

</html>
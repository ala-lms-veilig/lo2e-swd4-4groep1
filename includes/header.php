<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="index.php">
                <img src="./images/MBO_Rijnland_Logo.png" alt="Company Logo" class="logo-img">
            </a>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="plattegrond.php">Plattegrond</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a href="account.php">Account</a></li>
                <?php else: ?>
                    <li><a href="inlog.php">Inloggen</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>
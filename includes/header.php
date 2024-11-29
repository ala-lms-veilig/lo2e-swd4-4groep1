<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="./styles/styling-v2.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <a href="index.php"><img src="./images/logov2.png" alt="Company Logo" class="logo-img"></a>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="plattegrond.php">Plattegrond</a></li>
            <li><a href="meldingen.php">Meldingen</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php
            session_start();
            if (isset($_SESSION['userID'])) {
                echo '<li><a href="account.php">Account</a></li>';
            } else {
                echo '<li><a href="inlog.php">Inloggen</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
</body>
</html>
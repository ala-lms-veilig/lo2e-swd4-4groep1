<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php 
    require_once 'includes/header.php'; 
    require 'includes/auth.php';
    ?>

    <main id="account_main">
        <h1>Welkom op account page</h1>
        <p>Hallo, <?php echo $_SESSION['firstName']; ?>!</p>
        <form action="includes/logout.php" method="post">
            <button type="submit">Loguit</button>
        </form>
        <?php 
    echo $_SESSION['userID'];
    ?>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>
</html>     
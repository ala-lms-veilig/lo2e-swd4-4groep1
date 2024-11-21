<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/styling-v2.css">
</head>
<body>
    <?php 
    require_once 'includes/header.php'; 
    

    if (!isset($_SESSION['userID'])) {
        header("Location: inlog.php");
        exit;
    }
    ?>

    <main id="account_main">
        <h1>Welkom op account page</h1>
        <p>Hallo, <?php echo $_SESSION['firstName']; ?>!</p>
        <form action="includes/logout.php" method="post">
            <button type="submit">Loguit</button>
        </form>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>
</html>     
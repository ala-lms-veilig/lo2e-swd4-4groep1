<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/styling-v2.css">
</head>

<body id="body">
    <?php
    require_once 'includes/header.php';

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
    ?>

    <main id="account_main" class="account-main">
        <h1 class="title">Welkom op account page</h1>
        <p class="welcome-text">Hallo, <?php echo htmlspecialchars($_SESSION['voor_naam']); ?>!</p>

        <h1>links naar admin mogelijkheden </h1>
        <a href="news_admin.php">admin news</a>
        <a href="meldingen.php">meldingen pagina</a>
         <a href="melding_admin.php">admin melding pagina </a>   
        <form class="logout-form" action="includes/logout.php" method="post">
            <button class="btn btn-primary" type="submit">Loguit</button>
        </form>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>

</html>
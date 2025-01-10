
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
<link rel="stylesheet" href="./styles/style.css">

</head>
<body id="body-a">
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

    <main id="account_main" class="account-main fade-in">
        <h1 class="title">Welkom op je accountpagina</h1>
        <p class="welcome-text">Hallo, <?php echo htmlspecialchars($_SESSION['voor_naam']); ?>!</p>

        <?php if ($_SESSION['rol_id'] == 1): ?>
            <h2>Links naar admin mogelijkheden</h2>
            <div class="links">
                <a href="news_admin.php">Admin News</a>
                <a href="meldingen.php">Meldingen Pagina</a>
                <a href="melding_admin.php">Admin Melding Pagina</a>
                <a href="user_acounts.php">Account</a>
            </div>
        <?php elseif ($_SESSION['rol_id'] == 2): ?>
            <h2>Links naar specifieke mogelijkheden</h2>
            <div class="links">
                <a href="user_acounts.php">Account</a>
            </div>
        <?php elseif ($_SESSION['rol_id'] == 3): ?>
            <h2>Account informatie</h2>
            <p>Je hebt alleen toegang tot account informatie.</p>
        <?php endif; ?>

        <form class="logout-form" action="includes/logout.php" method="post">
            <button class="btn btn-primary" type="submit">Loguit</button>
        </form>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>
</html>
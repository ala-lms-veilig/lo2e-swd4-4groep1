<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body class="index-body">
    <?php require_once 'includes/header.php'; ?>
    <main id="index_main">
        <section class="main-tile">
            <h1>Welkom</h1>
            <p>Een productieve dag gewenst</p>
            <article>
                <a id="meldingMaken" href="melding_aanmaken.php">Maken</a>
                <a id="incidentenBekijken" href="meldingen.php">Bekijken</a>
            </article>
            <a id="enquête" href="enquêtes.php">Enquête</a>
        </section>
    </main>
    <?php require_once 'includes/footer.php'; ?>
</body>
</html>
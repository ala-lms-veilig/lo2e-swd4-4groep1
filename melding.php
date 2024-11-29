<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Incident Page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include './includes/header.php'; ?>
    </header>
    <main id="main-incident-page">
        <section id="incident-info-container">
            <section id="incident-primary-info-container">
                <h1 class="single-incident-titles">Test</h1>
                <p class="single-incident-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias eligendi vitae dignissimos? Asperiores praesentium illo illum nesciunt quod, ad ullam excepturi minima saepe quo reprehenderit possimus minus ratione! Ex, sapiente.</p>
            </section>
            <section id="incident-notes-container">
                <section id="incident-secondary-info-container">
                    <p>Door:</p>
                    <p>Categorie:</p>
                    <p>Prioriteit:</p>
                    <p>Gemaakt:</p>
                    <p>Geupdate:</p>
                    <p>Status:</p>
                    <p>Toren:</p>
                    <p>Verdieping:</p>
                    <p>Lokaal:</p>
                </section>
            </section>
        </section>
        <section id="incident-img-container">
            <img id="single-incident-img">
        </section>
        <section id="incident-notes_chat-container">
            <h1 class="single-incident-titles">Interne notities</h1>
                <p class="single-incident-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias eligendi vitae dignissimos? Asperiores praesentium illo illum nesciunt quod, ad ullam excepturi minima saepe quo reprehenderit possimus minus ratione! Ex, sapiente.</p>

            <section id="incident-chat-container">

            </section>
        </section>
    </main>
    <footer>
        <?php include './includes/footer.php'; ?>
    </footer>
</body>
</html>
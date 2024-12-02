<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="./js/script.js" defer></script>
  <title>Incident Page</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body onload="showIncidents(); getChatMessages();">
    <?php include './includes/header.php'; ?>
    <main id="main-incident-page">
        <section id="incident-info-container">
            <section id="info-container">
                <section id="texts-container">
                    <section id="incident-infos-container">
                        <h1 class="single-incident-titles">Titel</h1>
                        <h1 class="single-incident-texts">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, officia dolore. Tempora eum fuga autem quae excepturi quod, laboriosam tenetur eaque officia earum illum consequuntur nisi quisquam nostrum, eligendi impedit?</h1>
                    </section>
                    <section id="incident-notes-container">
                        <h1 class="single-incident-titles">Interne notitie</h1>
                        <h1 class="single-incident-texts">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam rem fugiat cum quasi enim necessitatibus nostrum perspiciatis, placeat laborum repellat exercitationem architecto nobis quidem? Eaque odit omnis inventore possimus perferendis.</h1>
                    </section>
                </section>
                <section id="img-container">

                </section>
            </section>
            <section id="single-incident-details-container">
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Door:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Categorie:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Prioriteit:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Gemaakt:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Status:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Toren:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Veridiepng:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Lokaal:</p>
                    <p class="single-incident-details-text"></p>
                </section>
                <section class="single-incident-detail-container">
                    <p class="single-incident-details-title">Geupdate:</p>
                    <p class="single-incident-details-text"></p>
                </section>
            </section>
        </section>
        <section id="chat-container">
            <section id="chat-top-bar">
                <p id="chat-top-bar-text">Chat met gebruiker</p>
            </section>
            <section id="chat-messages-container">
                <template id="message-template">
                    <section class="message">
                        <p class="chat-name"></p>
                        <p class="chat-message"></p>
                    </section>
                </template>
            </section>
            <section id="message-input-container">
                <form>
                    <input type="file">
                    <input>
                    <button></button>
                </form>
            </section>
        </section>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>
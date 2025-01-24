<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="./js/script.js" defer></script>
  <title>Incident Page</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body onload="showIncidents(); getChatMessages(); incidentEventListeners();">
    <?php include './includes/header.php'; ?>
    <main id="main-incident-page">
        <section id="incident-info-container">
            <section id="info-container">
                <section id="texts-container">
                    <section id="incident-infos-container">
                        <template class="incident-title-template">
                            <h1 class="single-incident-titles editable">Titel</h1>
                            <h1 class="single-incident-texts editable"></h1>
                        </template>
                    </section>
                        <template class="incident-notes-container-template">
                            <section id="incident-notes-container">
                                <h1 class="single-incident-titles">Interne notitie</h1>
                                <h1 class="single-incident-texts internal-note editable"></h1>
                            </section>
                        </template>
                </section>
                <section id="img-container">

                </section>
            </section>
            <section id="single-incident-details-container">
                <template class="single-incident-details-template">
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Door:</p>
                        <p class="single-incident-details-text id-author"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Categorie:</p>
                        <p class="single-incident-details-text id-category editable"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Prioriteit:</p>
                        <p class="single-incident-details-text id-priority editable"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Gemaakt:</p>
                        <p class="single-incident-details-text id-create_date"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Status:</p>
                        <p class="single-incident-details-text id-status editable"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Toren:</p>
                        <p class="single-incident-details-text id-tower editable"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Verdieping:</p>
                        <p class="single-incident-details-text id-floor editable"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Lokaal:</p>
                        <p class="single-incident-details-text id-class_area editable"></p>
                    </section>
                    <section class="single-incident-detail-container">
                        <p class="single-incident-details-title">Geupdate:</p>
                        <p class="single-incident-details-text id-update_date"></p>
                    </section>
                    <template class="edit-button-template">
                        <section class="single-incident-detail-container" id="single-incident-edit-button-container">
                            <button type="button" onclick="editIncident()" id="single-incident-edit-button">Bewerk</button>
                        </section>
                    </template>
                </template>
            </section>
        </section>
        <section id="chat-container">
            <section id="chat-top-bar">
                <p id="chat-top-bar-text">Chat met gebruiker</p>
            </section>
                <template id="message-template">
                    <section class="message">
                        <div class="chat-message-details">
                            <p class="chat-name"></p>
                            <p class="chat-time"></p>
                        </div>
                        <p class="chat-message"></p>
                    </section>
                </template>
                <template id="message-date-template">
                    <p class="message-date"></p>
                </template>
            <section id="chat-messages-container-reverse">
                <section id="chat-messages-container">

                </section>
            </section>
            <section id="message-media-path-container">
                <p id="message-media-path"></p>
                <a id="media-delete-button" href="javascript:resetFileInput('single_incident')"><img id="new-incident-media-delete-button-icon" src="./images/trashbin.png"></a>
            </section>
            <section id="message-input-container">
                <form id="message-input-form" method="POST" action="javascript:sendChatMessage();">
                    <div id="message-media-input-container">
                        <label class="new-incident-label" id="media-button" for="media-input">+</label>
                        <input class="media-input" id="media-input"  type="file">
                    </div>
                    <input type="text" placeholder="Type uw bericht..." id="message-input">
                    <button type="submit" id="message-send-button">></button>
                </form>
            </section>
        </section>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>
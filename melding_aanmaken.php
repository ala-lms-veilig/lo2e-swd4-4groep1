<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./js/script.js" defer></script>
    <title>Melding aanmaken</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="./styles/styling-v2.css">
</head>
<body onload="newIncidentEvents()">
    
    <?php require_once 'includes/header.php'; ?>

    <main id="melding-maken_main">
        <form id="new-incident-form" method="POST" action="./includes/api.php?action=createIncident">
            <div id="new-incident-columns-container">
                <div class="new-incident-column">
                    <fieldset class="new-incident-fieldset">
                        <label class="new-incident-label">Welke prioriteit heeft uw melding?</label>
                        <input list="priorities" id="new-incident-priority-input" class="new-incident-input">
                        <datalist class="new-incident-input" id="priorities" name="priorities">
                            <option value="1">Prioriteit 1</option>
                            <option value="2">Prioriteit 2</option>
                            <option value="3">Prioriteit 3</option>
                            <option value="4">Prioriteit 4</option>
                            <option value="5">Prioriteit 5</option>
                        </datalist>
                    </fieldset>
                    <fieldset class="new-incident-fieldset">
                        <label class="new-incident-label">Titel:</label>
                        <input class="new-incident-input" id="new-incident-title-input" type="text">
                    </fieldset>
                    
                    <fieldset class="new-incident-fieldset">
                        <label class="new-incident-label">Toren:</label>
                        <input list="towers" id="new-incident-tower-input" class="new-incident-input">
                        <datalist class="new-incident-input" id="towers" name="towers">
                            <option value="1">Toren A</option>
                            <option value="2">Toren B</option>
                            <option value="3">Toren C</option>
                            <option value="4">Anders</option>
                        </datalist>
                    </fieldset>
                    <fieldset class="new-incident-fieldset">
                        <label class="new-incident-label">Lokaal:</label>
                        <input class="new-incident-input" id="new-incident-class-input" type="text">
                    </fieldset>
                </div>
                <div class="new-incident-column" id="new-incident-right-column">
                    <fieldset class="new-incident-fieldset">
                        <label class="new-incident-label">Welke categorie valt uw melding in?</label>
                        <input list="categories" id="new-incident-category-input" class="new-incident-input">
                        <datalist class="new-incident-input" id="categories" name="categories">
                            <option value="1">Categorie 1</option>
                            <option value="2">Categorie 2</option>
                            <option value="3">Categorie 3</option>
                            <option value="4">Categorie 4</option>
                            <option value="5">Categorie 5</option>
                        </datalist>
                    </fieldset>
                    <fieldset class="new-incident-fieldset">
                        <label class="new-incident-label">Media (optioneel):</label>
                        <div id="new-incident-media-input-container">
                            <label class="new-incident-label" id="new-incident-media-button" for="new-incident-media-input">Voeg media toe</label>
                            <input class="new-incident-input" id="new-incident-media-input"  type="file">
                            <a id="new-incident-media-delete-button" href="javascript:resetFileInput()"><img id="new-incident-media-delete-button-icon" src="./images/trashbin.png"></a>
                        </div>
                    </fieldset>
                    <fieldset class="new-incident-fieldset">
                        <label class="new-incident-label">Verdieping:</label>
                        <input list="floors" id="new-incident-level-input" class="new-incident-input">
                        <datalist class="new-incident-input" id="floors" name="floors">
                            <option value="1">Verdieping 0</option>
                            <option value="2">Verdieping BG</option>
                            <option value="3">Verdieping 1</option>
                            <option value="4">Verdieping 2</option>
                            <option value="5">Verdieping 3</option>
                            <option value="6">Verdieping 4</option>
                            <option value="7">Verdieping 5</option>
                            <option value="8">Verdieping 6</option>
                            <option value="9">Verdieping 7</option>
                            <option value="10">Verdieping 8</option>
                            <option value="11">Verdieping 9</option>
                            <option value="12">Verdieping 10</option>
                        </datalist>
                    </fieldset>
                </div>
            </div>
            <div id="new-incident-description-container">
                <fieldset class="new-incident-fieldset" id="new-incident-description-fieldset">
                    <label class="new-incident-label">Beschrijving:</label>
                    <input class="new-incident-input" id="new-incident-description-input" type="text">
                </fieldset>
            </div>
            <button type="submit" id="new-incident-button">Verstuur</button>
        </form>
    </main>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
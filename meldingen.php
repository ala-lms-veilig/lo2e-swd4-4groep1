<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./js/script.js" defer></script>
    <title>Meldingen</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body onload="showIncidents()" >
    <?php require 'includes/header.php';
    require './includes/auth.php';
    ?>
<template class="incident-template">
        <section class="incident-container">
            <section class="column-id">
                <h1 class="incident-title">ID</h1>
                <h1 class="incident-id incident-text"></h1>
            </section>
            <section class="column-title">
                <h1 class="incident-title">Titel</h1>
                <h1 class="incident-titles incident-text"></h1>
            </section>
            <section class="column-description">
                <h1 class="incident-title">Beschrijving</h1>
                <h1 class="incident-description incident-text"></h1>
            </section>
            <section class="column-category">
                <h1 class="incident-title">Categorie</h1>
                <h1 class="incident-category incident-text"></h1>
            </section>
            <section class="column-priority">
                <h1 class="incident-title">Prioriteit</h1>
                <h1 class="incident-priority incident-text"></h1>
            </section>
            <section class="column-status">
                <h1 class="incident-title">Status</h1>
                <h1 class="incident-status incident-text"></h1>
            </section>
            <section class="column-actions">
                <h1 class="incident-title">Acties</h1>
                <section class="incident-buttons-container">
                    <a class="incident-button incident-goto-button"><img class="incident-button-img" src="./images/goto.png"></a>
                    <a class="incident-button incident-delete-button"><img class="incident-button-img" src="./images/trashbin.png"></a>
                </section>
            </section>
        </section>
    </template>
    <main id="meldingen_main">
        <section id="main-container">
            <section id="melding-top">
                <article id="filters-container">
                    <form id="filter-form">
                        <section class="filter-column">
                            <div class="dropdown">
                                <button class="dropdown-button">Prioriteit<h1>⯆</h1></button>
                                <div class="dropdown-menu">
                                    <label><input type="checkbox" value="Option 1">Prioriteit 1</label>
                                    <label><input type="checkbox" value="Option 2">Prioriteit 2</label>
                                    <label><input type="checkbox" value="Option 3">Prioriteit 3</label>
                                </div>
                            </div>
                        </section>
                        <section class="filter-column">
                            <div class="dropdown">
                                <button class="dropdown-button">Categorie<h1>⯆</h1></button>
                                <div class="dropdown-menu">
                                    <label><input type="checkbox" value="Option 1">ICT</label>
                                    <label><input type="checkbox" value="Option 2">Sanitair</label>
                                    <label><input type="checkbox" value="Option 3">Helpdesk</label>
                                </div>
                            </div>
                        </section>
                        <section class="filter-column">
                            <div class="dropdown">
                                <button class="dropdown-button">Status<h1>⯆</h1></button>
                                <div class="dropdown-menu">
                                    <label><input type="checkbox" value="Option 1">Open</label>
                                    <label><input type="checkbox" value="Option 2">In Progress</label>
                                    <label><input type="checkbox" value="Option 3">Closed</label>
                                </div>
                            </div>
                        </section>
                        <section class="filter-column">
                            <label class="filter-label" for="filter-date-start">Na:</label>
                            <input class="filter-input" type="date" id="filter-date-start" name="date_start">
                        </section>
                        <section class="filter-column">
                            <label class="filter-label" for="filter-date-end">Voor:</label>
                            <input class="filter-input" type="date" id="filter-date-end" name="date_end">
                        </section>
                    </form>
                </article>
                <article id="melding-aanmaken-container">
                    <a id="melding-aanmaken-button" href="plattegrond.php">Nieuwe melding</a>
                </article>
            </section>
            <section id="incidents-container">

            </section>
        </section>
    </main>
    <?php require 'includes/footer.php'; ?>
</body>
</html>
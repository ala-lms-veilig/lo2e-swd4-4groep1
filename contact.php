<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    
    <?php require 'includes/header.php'; ?>

    <main id="contact_main">
        <template id="contact_template">
            <section>
                <div class="contact_img"></div>
                <article>
                    <div>
                        <h4>Beroep:</h4>
                        <p class="contact_beroep">???</p>
                    </div>
                    <div>
                        <h4>Naam:</h4>
                        <p class="contact_naam">???</p>
                    </div>
                    <div>
                        <h4>telefoon nummer:</h4>
                        <p class="contact_tel">???</p>
                    </div>
                </article>
            </section>
        </template>
    </main>

    <?php require 'includes/footer.php'; ?>

    <script src="scripts/contact.js"></script>
</body>
</html>

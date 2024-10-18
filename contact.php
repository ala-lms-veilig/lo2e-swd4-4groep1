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
                <div><img class="contact_img" src="images/logo.png" alt="img"></div>
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

        <div id="container"></div> <!-- Fixed the ID from 'contact_container' to 'container' -->

    </main>

    <?php require 'includes/footer.php'; ?>

</body>
</html>

<script>
    const users = [
        { naam: "Anna de Vries",    beroep: "baker",    telNummer: 123456789, img: "images/logo.png" },
        { naam: "Bram Jansen",      beroep: "baker",    telNummer: 987654321, img: "images/logo.png" },
        { naam: "Carla Pietersen",  beroep: "baker",    telNummer: 555666777, img: "images/logo.png" }
    ];

    const template  = document.getElementById("contact_template");
    const container = document.getElementById("container");

    for (const user of users) {
        const clone = template.content.cloneNode(true);

        const img       = clone.querySelector(".contact_img");
        const beroep    = clone.querySelector(".contact_beroep");
        const naam      = clone.querySelector(".contact_naam");
        const telNummer = clone.querySelector(".contact_tel");

        img.src             = user.img;  
        beroep.textContent  = user.beroep;
        naam.textContent    = user.naam;
        telNummer.textContent = user.telNummer;

        container.appendChild(clone);
    }
</script>

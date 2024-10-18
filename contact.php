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

        <div id="container"></div>

    </main>

    <?php require 'includes/footer.php'; ?>

</body>
</html>

<script>

    async function showContactInfo() {
        const response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/contacts`);


        if (!response.ok) {
            throw new Error(`Failed to fetch: ${response.status} ${response.statusText}`);
        }

        const contacts = await response.json();

        console.log(contacts);

        const template = document.getElementById("contact_template");
        const container = document.getElementById("container");

        for (let contact of contacts) {
            const clone = template.content.cloneNode(true);

            const img       = clone.querySelector(".contact_img");
            const beroep    = clone.querySelector(".contact_beroep");
            const naam      = clone.querySelector(".contact_naam");
            const telNummer = clone.querySelector(".contact_tel");

            img.src                 = `images/${contact.img}`;
            beroep.textContent      = contact.beroep;
            naam.textContent        = contact.naam;
            telNummer.textContent   = contact.telNummer;

            container.appendChild(clone);
        }
    }

    showContactInfo();
        
    
</script>

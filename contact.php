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
    // https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/contacts
    async function showContactInfo() {
        const response = await fetch(`http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json`);

        const contacts = await response.json();

        console.log(contacts.contacts);

        const template = document.getElementById("contact_template");
        const container = document.getElementById("container");

        // Remove .contacts if using the server
        for (let contact of contacts.contacts) {
            const clone = template.content.cloneNode(true);

            const img       = clone.querySelector(".contact_img");
            const beroep    = clone.querySelector(".contact_beroep");
            const naam      = clone.querySelector(".contact_naam");
            const telNummer = clone.querySelector(".contact_tel");

            img.innerHTML       = `images/${contact.img}`;
            beroep.innerHTML    = contact.beroep;
            naam.innerHTML      = contact.naam;
            telNummer.innerHTML = contact.telNummer;

            container.appendChild(clone);
        }
    }

    showContactInfo();
        
</script>

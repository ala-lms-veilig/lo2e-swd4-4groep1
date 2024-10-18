// http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json
async function showContactInfo() {
    const response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/contacts`);
    const contacts = await response.json();

    console.log(contacts);

    const template = document.getElementById("contact_template");
    const container = document.getElementById("contact_main");

    // If server doesn't work use contacts.contacts
    for (let contact of contacts) {
        const clone = template.content.cloneNode(true);

        const img       = clone.querySelector(".contact_img");
        const beroep    = clone.querySelector(".contact_beroep");
        const naam      = clone.querySelector(".contact_naam");
        const telNummer = clone.querySelector(".contact_tel");

        img.innerHTML = `<img src="images/${contact.img}" alt="${contact.title}">`;
        beroep.innerHTML    = contact.beroep;
        naam.innerHTML      = contact.naam;
        telNummer.innerHTML = contact.telNummer;

        container.appendChild(clone);
    }
}

showContactInfo();
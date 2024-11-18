<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquête over Veiligheid</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
 
    <?php require_once 'includes/header.php'; ?>
 
    <main>
        <div id="enquêtes_main">
            <h2>Enquête over Veiligheid</h2>
            <form id="enqueteForm">
                <template id="question">
                    <label id="vraag">Hoe tevreden ben je met de veiligheid in jouw buurt?</label>
                    <div>
                        <input id="01" type="radio" name="vraag1" value="1"> 1
                        <input id="02" type="radio" name="vraag1" value="2"> 2
                        <input id="03" type="radio" name="vraag1" value="3"> 3
                        <input id="04" type="radio" name="vraag1" value="4"> 4
                        <input id="05" type="radio" name="vraag1" value="5"> 5
                        <input id="06" type="radio" name="vraag1" value="6"> 6
                        <input id="07" type="radio" name="vraag1" value="7"> 7
                        <input id="08" type="radio" name="vraag1" value="8"> 8
                        <input id="09" type="radio" name="vraag1" value="9"> 9
                        <input id="10" type="radio" name="vraag1" value="10"> 10
                    </div>
                </template>
                <div id="container"></div>
                <button type="submit" id="submitBtn">Verzenden</button>
            </form>
        </div>
    </main>
 
    <?php require_once 'includes/footer.php'; ?>
 

    <script>

// GET (all): Get all records
async function showAllRecords() {
     // http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json
    const response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/test`);
    const records = await response.json();

    console.log(records);

    const template = document.getElementById('record_template');
    const container = document.getElementById("record_main");

    // If server doesn't work use records.test
    for(let record of records) {
        const clone = template.content.cloneNode(true);

            const img       = clone.querySelector(".recordAll_img_temp");
            const naam      = clone.querySelector(".recordAll_naam_temp");
            const text      = clone.querySelector(".recordAll_text_temp");
            const nummer    = clone.querySelector(".recordAll_nummer_temp");

            //img.src           = `images/${record.img}`; // If directly in <img>
            img.innerHTML       = `<img src="images/${record.img}" alt="${record.naam}">`;
            naam.innerHTML      = record.naam;
            text.innerHTML      = record.txt;
            nummer.innerHTML    = record.nummer;

            container.appendChild(clone);
    }
}

showAllRecords();

















        const users = [
            { vraag: "Hoe veilig voel je je in jouw buurt?" },
            { vraag: "Wat vind je van de verlichting in jouw straat?" },
            { vraag: "Hoe vaak zie je politie in jouw buurt?" },
            { vraag: "Hoe veilig voel je je in jouw buurt?" }
        ];
 
        const template = document.getElementById("question");
        const container = document.getElementById("container");
 
       
        for (const user of users) {
            const clone = template.content.cloneNode(true);
            const vraag = clone.querySelector("#vraag");
 
            vraag.textContent = user.vraag;
 
            container.appendChild(clone);
        }
 
       
        document.getElementById("enqueteForm").addEventListener("submit", function(event) {
            event.preventDefault();
 
            const antwoorden = [];
 
           
            users.forEach((user, index) => {
                const antwoord = document.querySelector(`input[name="vraag${index + 1}"]:checked`);
                if (antwoord) {
                    antwoorden.push({ vraag: user.vraag, antwoord: antwoord.value });
                }
            });
 
            console.log(antwoorden);
            alert("Bedankt voor uw deelname aan de enquête!");
        });
    </script>
 
</body>
</html>
 
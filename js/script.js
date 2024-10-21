console.log("test")

function createIncident() {
    incidents = JSON.parse(localStorage.getItem("incidents") || "[]");
    if (incidents.length == 0) {
        id = 0;
    } else {
        id = incidents[incidents.length - 1].id + 1
    }
    incident = {
        id: id,
        priority: document.getElementById("new-incident-priority-input").value,
        category: document.getElementById("new-incident-category-input").value,
        title: document.getElementById("new-incident-title-input").value,
        media: document.getElementById("new-incident-media-input").value,
        description: document.getElementById("new-incident-description-input").value
    }
    incidents.push(incident)
    localStorage.setItem("incidents", JSON.stringify(incidents));
    incidents = JSON.parse(localStorage.getItem("incidents", incidents));
    console.log(incidents);

}
const getFileName = (event) => {
    const files = event.target.files;
    const fileName = files[0].name;
    document.getElementById("new-incident-media-delete-button").style.display = "block";
    document.getElementById("new-incident-media-button").innerHTML = fileName;
    console.log(document.getElementById("new-incident-media-input").value)
}

function resetFileInput() {
    document.getElementById("new-incident-media-input").value = "";
    document.getElementById("new-incident-media-delete-button").style.display = "none";
    if (document.getElementById("new-incident-media-input").value == "") {
        document.getElementById("new-incident-media-button").innerHTML = "Voeg media toe"
    } else {
        console.log(document.getElementById("new-incident-media-input").value)
    }
}

function newIncidentEvents() {
    document.getElementById("new-incident-media-input").addEventListener("change", getFileName)
}

function loadIncidents() {
    console.log("hi")
}

function showIncidents() {
    element = document.getElementById("meldingen_main");
    incidents = JSON.parse(localStorage.getItem("incidents"));
    console.log(incidents)
    console.log(incidents.length)
    for (var i = 0; i < incidents.length; i++){
        element.innerHTML += `
        <section class="incident-container">
            <section class="column-1">
                <h1 class="incident-title">Titel:</h1>
                <h1 class="incident-text">` + incidents[i].title + `</h1>
            </section>
            <section class="column-2">
                <h1 class="incident-title">Beschrijving:</h1>
                <h1 class="incident-text">` + incidents[i].description  + `</h1>
            </section>
            <section class="column-3">
                <h1 class="incident-title">Categorie:</h1>
                <h1 class="incident-text">` + incidents[i].category + `</h1>
            </section>
            <section class="column-4">
                <h1 class="incident-title">Prioriteit:</h1>
                <h1 class="incident-text">` + incidents[i].priority + `</h1>
            </section>
            <section class="column-5">
                <h1 class="incident-title">Acties:</h1>
                <a class="incident-delete-button" href="javascript:deleteIncident(` + i + `)"><img class="incident-delete-button-img" src="./images/trashbin.png"></a>
            </section>
        </section>
        `;
    }
}

function deleteIncident(index) {
    incidents = JSON.parse(localStorage.getItem("incidents"))
    incidents.splice(index, 1);
    localStorage.setItem("incidents", JSON.stringify(incidents));
}
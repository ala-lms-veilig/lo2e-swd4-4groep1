async function createIncident() {
    try {
        data = {
            priority: document.getElementById("new-incident-priority-input").value,
            category: document.getElementById("new-incident-category-input").value,
            title: document.getElementById("new-incident-title-input").value,
            media: "test",
            description: document.getElementById("new-incident-description-input").value,
            tower: document.getElementById("towers").value,
            floor: document.getElementById("floors").value,
            class_area: document.getElementById("new-incident-class-input").value,
            status: 1
        }
        const response = await fetch('./includes/api.php?action=createIncident', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await responseHandler(response);
        console.log(result);
        } catch (error) {
            console.log(JSON.stringify(data));
            errorHandler(error, 'createIncident');
        }
}

function getFileName(event) {
    try {
        const files = event.target.files;
        const fileName = files[0].name;
        document.getElementById("new-incident-media-delete-button").style.display = "block";
        document.getElementById("new-incident-media-button").innerHTML = fileName;
    } catch (error) {
        errorHandler(error, 'getFileName');
    }
}

function resetFileInput() {
    try {
        document.getElementById("new-incident-media-input").value = "";
        document.getElementById("new-incident-media-delete-button").style.display = "none";
        if (document.getElementById("new-incident-media-input").value == "") {
            document.getElementById("new-incident-media-button").innerHTML = "Voeg media toe"
        } else {
            console.log(document.getElementById("new-incident-media-input").value)
        }
    } catch (error) {
        errorHandler(error, 'resetFileInput');
    }
}

function newIncidentEvents() {
        document.getElementById("new-incident-media-input").addEventListener("change", getFileName);
        getLocation()
}

async function showIncidents() {
    id = new URLSearchParams(window.location.search).get("id");
    console.log(id);
    if (id == undefined) {
        try {
            const response = await fetch('./includes/api.php?action=showIncidents');
            const incidents = await responseHandler(response);
            const incidentsContainer = document.getElementById('incidents-container');
            const incidentTemplate = document.querySelector('.incident-template');

            incidentsContainer.innerHTML = '';
            console.log(incidents);
            if (Array.isArray(incidents)) {
                incidents.forEach((incident) => {
                    console.log(incident);
                    const clone = incidentTemplate.content.cloneNode(true);

                    clone.querySelector('.incident-id').textContent = incident.id;
                    clone.querySelector(".incident-titles").textContent = incident.title;
                    clone.querySelector(".incident-description").textContent = incident.description;
                    clone.querySelector(".incident-category").textContent = incident.category;
                    clone.querySelector(".incident-priority").textContent = incident.priority;
                    clone.querySelector(".incident-status").textContent = incident.status;
                    clone.querySelector(".incident-goto-button").href = "melding.php?id=" + incident.id;
                    clone.querySelector(".incident-delete-button").href = "javascript:deleteIncident(" + incident.id + ")";

                    incidentsContainer.appendChild(clone);
                })
            };
        } catch (error) {
            errorHandler(error, 'showIncidents')
        }
    } else {
        console.log("id detected")
        try {
            const response = await fetch(`./includes/api.php?action=showIncidents&id=${id}`);
            const incident = await responseHandler(response);

            console.log(incident);
        } catch (error) {
            errorHandler(error, 'showIncidents')
        }
    }
}


async function deleteIncident(incidentID) {
    try {
        const response = await fetch('./includes/api.php?action=deleteIncident&incidentID=' + incidentID, {
            method: 'POST',
        });

        const result = await responseHandler(response);
        if (result.success) {
            await showIncidents();
        }
    } catch (error) {
        errorHandler(error, 'deleteIncident');
    }
}


async function responseHandler(response) {fhow
    if (!response.ok) {
        const errorDetails = response.text();
        throw new Error(`API request failed with status ${response.status}: ${errorDetails}`);
    }
    return await response.json();
}

function errorHandler(error, context) {
    console.error(`Error in ${context}: `, error);
    alert(`An error occurred. Please try again later.`);
}

async function login() {
    try {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        console.log(email, password);

        const response = await fetch('./includes/api.php?action=login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username: email,
                password: password,
            }),
        });
        
        console.log(response);
        const result = await responseHandler(response);

        if (result.success) {
            console.log('Login successful:', result.message);
            window.location.href = 'dashboard.php';
        } else {
            errorHandler(error, "login")
        }
    } catch (error) {
        errorHandler(error, 'login');
    }
}

function insertBlueprintLinks() {
    cells = document.querySelectorAll('.blueprint-cell');
    var tower;
    for (var i = 0; i < cells.length; i++) {
        switch(true) {
            case cells[i].classList.contains("red"):
                var tower = "A";
                break;
            
            case cells[i].classList.contains("pink"):
                var tower = "B";
                break;

            case cells[i].classList.contains("purple"):
                var tower = "C";
                break;

            case cells[i].classList.contains("cyan"):
                var tower = "D";
                break;

            case cells[i].classList.contains("green"):
                var tower = "E";
                break;
        }

        cells[i].href = "melding_aanmaken.php?Toren=" + tower + "&Verdieping=" + cells[i].innerHTML;
    }
}

function getLocation() {
    towerInput = document.getElementById("towers");
    floorInput = document.getElementById("floors");


    selectedTower = new URLSearchParams(window.location.search).get("Toren");
    selectedFloor = new URLSearchParams(window.location.search).get("Verdieping");

    console.log(selectedTower)
    towerInput.value = selectedTower;
    floorInput.value = selectedFloor;
}

async function getChatMessages() {
    const response = await fetch('./includes/api.php?action=showIncidents');
    const replies = await responseHandler(response);

    const repliesContainer = document.getElementById('chat-messages-container');
    const messageTemplate = document.getElementById('message-template');


    ;
}
async function createIncident() {
    try {
        const response = await fetch('./includes/api.php?action=createIncident', {
            method: 'POST',
            body: JSON.stringify({
                priority: document.getElementById("new-incident-priority-input").value,
                category: document.getElementById("new-incident-category-input").value,
                title: document.getElementById("new-incident-title-input").value,
                media: document.getElementById("new-incident-media-input").value,
                description: document.getElementById("new-incident-description-input").value,
            })
        });

        const json = await responseHandler(response);
        console.log(json);
    } catch (error) {
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
    try {
        document.getElementById("new-incident-media-input").addEventListener("change", getFileName);
    } catch (error) {
        errorHandler(error, 'newIncidentEvents');
    }
}

async function showIncidents() {
    try {
        const response = await fetch('./includes/api.php?action=showIncidents');
        const incidents = await responseHandler(response);
        const incidentsContainer = document.getElementById('meldingen_main');
        const incidentTemplate = document.querySelector('.incident-template');

        incidentsContainer.innerHTML = '';
        if (Array.isArray(incidents)) {
            incidents.forEach((incident) => {
                const clone = incidentTemplate.content.cloneNode(true);

                clone.querySelector('.incident-id').textContent = incident.id;
                clone.querySelector(".incident-titles").textContent = incident.title;
                clone.querySelector(".incident-description").textContent = incident.description;
                clone.querySelector(".incident-category").textContent = incident.category;
                clone.querySelector(".incident-priority").textContent = incident.priority;
                clone.querySelector(".incident-goto-button").href = "melding.php?id=" + incident.id;
                clone.querySelector(".incident-delete-button").href = "javascript:deleteIncident(" + incident.id + ")";

                incidentsContainer.appendChild(clone);
            })
        };
    } catch (error) {
        errorHandler(error, 'showIncidents')
    }
}


async function deleteIncident(id) {
    try {
        let response = await fetch('https://jsonplaceholder.typicode.com/posts/' + id, {
            method: 'DELETE',
        });

        await responseHandler(response);
        console.log(`Incident with ID ${id} deleted successfully`);
    } catch (error) {
        errorHandler(error, 'deleteIncident');
    }
}


async function responseHandler(response) {
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
        // Get user input
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        console.log(email, password);

        // Send credentials to the server
        const response = await fetch('./includes/api.php?action=login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Ensure JSON format
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

            // Redirect or show dashboard
            window.location.href = 'dashboard.php';
        } else {
            errorHandler(error, "login")
        }
    } catch (error) {
        errorHandler(error, 'login');
    }
}
